<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UiController;



Route::group(['prefix' => 'ui', 'as'=>'ui.'], function($route){
    $route->any('/', [UiController::class, 'index'])->name('index');

});
