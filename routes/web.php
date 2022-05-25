<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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



Route::group(['middleware'=>['auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Admin routes, Role id - 1
    Route::group(['middleware'=>['roles:1']], function(){
        Route::controller(ProductController::class)->group(function(){
            Route::get('/product/create', 'create')->name('product.create');
            Route::post('/product', 'store')->name('product.store');
            Route::get('/product', 'index')->name('product.index');
            Route::get('/product/{product}/edit', 'edit')->name('product.edit');
            Route::put('/product/{product}/update', 'update')->name('product.update');
            Route::delete('/product/{product}/delete', 'destroy')->name('product.delete');
        });
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/order/create', 'create')->name('order.create');
        Route::post('/order', 'store')->name('order.store');
        Route::get('/order', 'index')->name('order.index');
        Route::get('order/{order}/edit', 'edit')->name('order.edit');
        Route::put('order/{order}/update', 'update')->name('order.update');
        Route::delete('order/{order}/delete', 'destroy')->name('order.delete');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/user', 'index')->name('user.index');
        Route::delete('order/{order}/delete', 'destroy')->name('user.delete');
    });
});
