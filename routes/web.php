<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require_once 'payment.php';
require_once 'admin.php';
require_once 'product.php';
require_once 'ui.php';

Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/test', function () {
    return view('test');
});
Auth::routes();


