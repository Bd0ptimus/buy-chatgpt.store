<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;



Route::group(['prefix' => 'admin', 'as'=>'admin.'], function($route){
    $route->any('/', [AdminController::class, 'index'])->name('index');
});
