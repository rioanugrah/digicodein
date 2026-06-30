<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['role:Administrator']], function(){
        Route::get('home', [App\Http\Controllers\HomeController::class, 'index_admin'])->name('admin.home')->middleware('verified');

        Route::controller(App\Http\Controllers\ProductCategoryController::class)->group(function () {
            Route::prefix('product_category')->group(function(){
                Route::get('/', 'index')->name('admin.product_category')->middleware('verified');
                Route::post('simpan', 'simpan')->name('admin.product_category.simpan')->middleware('verified');
                Route::get('{id}', 'detail')->name('admin.product_category.detail')->middleware('verified');
                Route::post('update', 'update')->name('admin.product_category.update')->middleware('verified');
                Route::post('delete', 'destroy')->name('admin.product_category.delete')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\ProductController::class)->group(function () {
            Route::prefix('products')->group(function(){
                Route::get('/', 'index')->name('admin.product')->middleware('verified');
                Route::post('simpan', 'simpan')->name('admin.product.simpan')->middleware('verified');
                Route::get('{id}', 'detail')->name('admin.product.detail')->middleware('verified');
                Route::post('update', 'update')->name('admin.product.update')->middleware('verified');
                Route::post('delete', 'delete')->name('admin.product.delete')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\OrdersController::class)->group(function () {
            Route::prefix('orders')->group(function(){
                Route::get('/', 'index')->name('admin.orders.index')->middleware('verified');
                Route::post('lisensi/simpan', 'lisensiSimpan')->name('admin.orders.lisensiSimpan')->middleware('verified');
                Route::get('{id}', 'detail')->name('admin.orders.detail')->middleware('verified');
                Route::get('{id}/invoice', 'invoice')->name('admin.orders.invoice')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\TransactionsController::class)->group(function () {
            Route::prefix('transactions')->group(function(){
                Route::get('/', 'payment_index')->name('admin.transaction.index')->middleware('verified');
                Route::get('{id}', 'payment_detail')->name('admin.transaction.detail')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\SliderController::class)->group(function () {
            Route::prefix('sliders')->group(function(){
                Route::get('/', 'index')->name('admin.slider.index')->middleware('verified');
                Route::post('simpan', 'simpan')->name('admin.slider.simpan')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\RoleController::class)->group(function () {
            Route::prefix('roles')->group(function(){
                Route::get('/', 'index')->name('admin.roles')->middleware('verified');
                Route::get('create', 'create')->name('admin.roles.create')->middleware('verified');
                Route::post('simpan', 'store')->name('admin.roles.store')->middleware('verified');
                Route::get('{id}', 'detail')->name('admin.roles.detail')->middleware('verified');
                Route::get('{id}/edit', 'edit')->name('admin.roles.edit')->middleware('verified');
                Route::post('{id}/update', 'update')->name('admin.roles.update')->middleware('verified');
                Route::delete('{id}/delete', 'destroy')->name('admin.roles.destroy')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\PermissionController::class)->group(function () {
            Route::prefix('permissions')->group(function(){
                Route::get('/', 'index')->name('admin.permission')->middleware('verified');
                Route::get('create', 'create')->name('admin.permission.create')->middleware('verified');
                Route::post('simpan', 'store')->name('admin.permission.store')->middleware('verified');
                Route::get('{id}/edit', 'edit')->name('admin.permission.edit')->middleware('verified');
                Route::post('{id}/update', 'update')->name('admin.permission.update')->middleware('verified');
                Route::delete('{id}/delete', 'destroy')->name('admin.permission.destroy')->middleware('verified');
            });
        });

        Route::controller(App\Http\Controllers\UserController::class)->group(function () {
            Route::prefix('users')->group(function(){
                Route::get('/', 'index')->name('admin.users')->middleware('verified');
                Route::get('create', 'create')->name('admin.users.create')->middleware('verified');
                Route::post('simpan', 'store')->name('admin.users.store')->middleware('verified');
                Route::get('{generate}', 'edit')->name('admin.users.edit')->middleware('verified');
                Route::post('{generate}/update', 'update')->name('admin.users.update')->middleware('verified');
            });
        });
    });
});
