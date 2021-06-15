<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('product', [ProductController::class, 'index'])->name('product');
Route::post('store', [ProductController::class, 'store'])->name('product_store');

Route::get('order', [OrderController::class, 'index'])->name('order');
Route::post('order_store', [OrderController::class, 'store'])->name('order_store');
Route::get('delete/{id}', [OrderController::class, 'delete']);
Route::get('edit/{id}', [OrderController::class, 'edit']);
Route::post('update/{id}', [OrderController::class, 'update'])->name('order_update');