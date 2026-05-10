<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['role:User']], function(){
        Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
            Route::get('dashboard', 'index_user')->name('user.home')->middleware('verified');

            Route::prefix('order')->group(function(){
                Route::get('{id}', 'detailOrderUser')->name('user.orderDetail')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\OrdersController::class)->group(function () {
            Route::prefix('order')->group(function(){
                Route::get('{id}/invoice', 'invoice')->name('user.orderInvoice')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\CartController::class)->group(function () {
            Route::prefix('cart')->group(function(){
                Route::get('/', 'cart')->name('user.cart')->middleware('verified');
                Route::post('delete', 'cartDelete')->name('user.cartDelete')->middleware('verified');
                Route::post('{slug}/add', 'cartAdd')->name('user.cartAdd')->middleware('verified');
            });

            Route::prefix('checkout')->group(function(){
                Route::post('/', 'cartCheckout')->name('user.cartCheckout')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\AccountController::class)->group(function () {
            Route::prefix('account')->group(function(){
                Route::get('/', 'index')->name('user.account')->middleware('verified');
                Route::post('update', 'update')->name('user.account.update')->middleware('verified');
            });
        });
    });
});
