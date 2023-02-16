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

//repo

use Exception;
class CheckoutService
{
    public function AddNewCheckout($request, $productId){
        $numberAccountLeft =  Account::where('product_id', $productId)->where('sold',ACCOUNT_NOT_SOLD )->get()->count();
        if($numberAccountLeft<$request->numberProduct){
            return null;
        }
        $checkout = Checkout::create([
            'payment_method_id' => $request->paymentMethod,
            'receiver_email' => $request->email,
            'amount_products' => $request->amountProducts,
            'checkout_code' => 'checkout',
            'product_id' => $productId,
            'amount_products' => $request->numberProduct,
        ]);

        $checkout->update([
            'checkout_code' => PRE_CODE.$checkout->id,
        ]);

        return $checkout;
    }
}
