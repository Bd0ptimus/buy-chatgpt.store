<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

//model
use App\Models\Checkout;
use App\Models\Account;
use App\Models\Product;


//repo


use App\Events\WaitingPaymentEvent;

use Exception;

class CheckoutService
{

    protected function moveAccountToNotSoldInCheckout($checkoutId)
    {
        Account::where('checkout_complete_id', $checkoutId)->update([
            'sold' => ACCOUNT_NOT_SOLD,
        ]);
    }
    public function clearCheckoutOutdate()
    {
        $currentTimestamp = Carbon::now();
        $checkouts = Checkout::where('status','!=', CHECKOUT_DONE)->get();
        foreach ($checkouts as $checkout) {
            // Define the timestamp to compare with
            $compareTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $checkout->created_at);
             // Calculate the time difference between the two timestamps
            $timeDifference = $currentTimestamp->diffInMinutes($compareTimestamp);
            if($timeDifference>15){
                $this->moveAccountToNotSoldInCheckout($checkout->id);
                $checkout->delete();
            }
        }
    }

    public function clearCheckout($checkoutId){
        $this->moveAccountToNotSoldInCheckout($checkoutId);
        $checkout=Checkout::find($checkoutId);
        $checkout->delete();
    }

    public function AddNewCheckout($request, $productId)
    {
        DB::beginTransaction();
        try{
            $accountLefts= Account::where('product_id', $productId)->where('sold', ACCOUNT_NOT_SOLD)->orderBy('created_at', 'desc')->get();
            $numberAccountLeft =  $accountLefts->count();
            if ($numberAccountLeft < $request->numberProduct) {
                return null;
            }
            $checkout = Checkout::create([
                'payment_method_id' => $request->paymentMethod,
                'receiver_email' => $request->email,
                'amount_products' => $request->amountProducts,
                'checkout_code' => 'checkout',
                'product_id' => $productId,
                'amount_products' => $request->numberProduct,
                'sum' =>  $request->numberProduct * Product::find($productId)->price,
                'receiver_name' => $request->name,
                'status'=> CHECKOUT_PENDING,
            ]);

            $checkout->update([
                'checkout_code' => PRE_CODE . $checkout->id,
            ]);

            foreach(range(1, $request->numberProduct) as $key){
                $accountLefts[$key-1]->update([
                    'checkout_complete_id' =>  $checkout->id,
                    'sold' => ACCOUNT_SOLD,
                ]);
            }
            DB::commit();
            return $checkout;

        }catch(\Exception $e){
            Log::debug('service type seeder : '.$e);
            DB::rollBack();
            return null;

        }
    }

    public function checkPayment($params){
        $checkout=Checkout::where('checkout_code', strtoupper($params['about']))
            ->where('sum',$params['income'] )->first();
        if(isset($checkout)){
            $checkout->update([
                'status'=>CHECKOUT_DONE,
            ]);
            event(new WaitingPaymentEvent(strtoupper($params['about']),PAYMENT_DONE));
            return PAYMENT_DONE;
        }else{
            $checkoutNotDone = Checkout::where('checkout_code', strtoupper($params['about']))->first();
            if(isset($checkoutNotDone)){
                if($checkoutNotDone->sum < $params['income']){
                    $checkoutNotDone->update([
                        'status' => CHECKOUT_DONE,
                    ]);
                    event(new WaitingPaymentEvent(strtoupper($params['about']),PAYMENT_DONE));
                    return PAYMENT_DONE;
                }else{
                    event(new WaitingPaymentEvent(strtoupper($params['about']),PAYMENT_NOT_TRUE));
                    return PAYMENT_NOT_TRUE;

                }
            }
            return PAYMENT_UNAVAILABLE;

        }
    }
}
