<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;



Route::group(['prefix' => 'admin', 'as'=>'admin.'], function($route){
    $route->any('/', [AdminController::class, 'index'])->name('index');

    Route::group(['prefix' => 'category', 'as'=>'category.'], function($route){
        $route->any('/', [ AdminController::class, 'categoryManager'])->name('index');
        $route->post('/add-category', [ AdminController::class, 'addCategory'])->name('addCategory');
        $route->any('/update-category/{categoryId}', [ AdminController::class, 'updateCategory'])->name('updateCategory');
        $route->get('/delete-category/{categoryId}', [ AdminController::class, 'deleteCategory'])->name('deleteCategory');

    });

    Route::group(['prefix' => 'product', 'as'=>'product.'], function($route){
        $route->any('/{categoryId}', [ AdminController::class, 'productManager'])->name('index');
        $route->post('/add-product/{categoryId}', [ AdminController::class, 'addProduct'])->name('addProduct');
        $route->post('/update-product/{productId}', [ AdminController::class, 'updateProduct'])->name('updateProduct');
        $route->get('/delete-product/{productId}', [ AdminController::class, 'deleteProduct'])->name('deleteProduct');

    });
});
