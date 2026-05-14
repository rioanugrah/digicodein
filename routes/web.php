<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
//     return view('frontend.index');
// });

Auth::routes(
    [
        'verify' => true,
        'register' => true
    ]
);

Route::controller(App\Http\Controllers\FrontendController::class)->group(function () {
    Route::prefix('/')->group(function(){
        Route::get('/', 'index')->name('frontend.index');
        Route::get('category/{slug}', 'category_product')->name('frontend.category_product');
        Route::get('product/{slug}', 'product_detail')->name('frontend.product_detail');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::controller(App\Http\Controllers\FrontendController::class)->group(function () {
        Route::prefix('product')->group(function(){
            Route::get('{slug}/order', 'order')->name('frontend.order')->middleware('verified');
            Route::post('{slug}/checkout', 'checkout')->name('frontend.checkout')->middleware('verified');
        });
    });

    // Auth Administrator
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified');

});

// Route::get('payment/test', [App\Http\Controllers\Payment\MidtransController::class, 'test_payment']);
// Route::get('testing/wa', [App\Http\Controllers\TestingController::class, 'testingWA']);
// Route::get('testing/telegram', [App\Http\Controllers\TestingController::class, 'testingTelegram']);
