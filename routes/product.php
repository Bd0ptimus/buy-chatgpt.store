<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;



Route::group(['prefix' => 'product', 'as'=>'product.'], function($route){
    $route->any('/{categoryId}', [ ProductController::class, 'index'])->name('index');
});


