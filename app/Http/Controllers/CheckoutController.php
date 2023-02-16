<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\LOG;

use App\Models\Product;
use App\Models\PaymentMethod;
use App\Models\Checkout;
use App\Models\Test;

use App\Events\WaitingPaymentEvent;
use App\Services\CheckoutService;

class CheckoutController extends Controller
{
    protected $checkoutService;
    public function __construct(CheckoutService $checkoutService){
        $this->checkoutService = $checkoutService;
    }
    public function shoppingCart(Request $request, $productId)
    {
        $product = Product::find($productId);
        $paymentMethods = PaymentMethod::get();
        return view('checkout.shoppingCart',[
            'product' => $product,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function waitingPayment(Request $request, $productId){
        // dd($request);
        $info = $this->checkoutService->AddNewCheckout($request, $productId);
        if(!isset($info)){
            return redirect()->back();
        }
        $paymentMethod = PaymentMethod::find($request->paymentMethod);
        return view('checkout.waitingPayment',[
            'paymentMethod' => $paymentMethod,
            'checkoutCode' => $info->checkout_code,
        ]);
    }

    public function paymentAccept(Request $request){
        event(new WaitingPaymentEvent($request->code,'done'));
        return null;
    }

    public function checkPayment(Request $request){
        try{
            Test::create([
                'ip_connected'=> $request->ip(),
                'data' => $request->data,
            ]);
        }catch(\Exception $e){
            LOG::debug('error in addCategory : ' . $e );
            return response()->json(['error' => 1, 'msg' => 'Đã có lỗi']);
        }
        return response()->json(['error' => 0, 'msg' => 'load category thanh cong', 'data'=> 'abc done']);




    }

}
