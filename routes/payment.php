<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PaymentController;



Route::group(['prefix' => 'payment', 'as'=>'payment.'], function($route){
    $route->any('/vnpay/{paymentAmount}/{checkoutId}', [ PaymentController::class, 'create'])->name('create');
    $route->any('/return-back',[PaymentController::class, 'return'])->name('return');

});
