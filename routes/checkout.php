<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\CheckoutController;



Route::group(['prefix' => 'checkout', 'as'=>'checkout.'], function($route){
    $route->any('/shopping-cart/{productId}', [ CheckoutController::class, 'shoppingCart'])->name('shoppingCart');
    $route->any('/waiting-payment/{productId}',[ CheckoutController::class, 'waitingPayment'])->name('waitingPayment');
    $route->any('/payment-accept',[CheckoutController::class, 'paymentAccept'])->name('paymentAccept');
    $route->any('check-payment', [CheckoutController::class, 'checkPayment'])->name('checkPayment');
});
