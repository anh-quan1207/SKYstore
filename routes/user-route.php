<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[FrontendController::class,'home'])->name('home_page_user');
Route::prefix('/')->middleware('guest')->group(function () { 
    Route::get('/login', [FrontendController::class, 'login'])->name('user-form-login');
    Route::post("/post-login", [FrontendController::class, 'authenticate'])->name('user-login');
    Route::get('/register', [FrontendController::class,'register'])->name('user-form-register');
    Route::post("/post-register", [FrontendController::class, 'postRegister'])->name('user-register');
});
Route::get('/logout', [FrontendController::class, 'logout'])->name('user-logout');
Route::get('/{parent_category}', [FrontendController::class, 'getByParentCategory'])->name('products-by-parent-category');
Route::get('/{id}/category', [FrontendController::class, 'getProductByCategory'])->name('products-by-category');
Route::prefix('/user')->middleware('auth')->group(function () {
    Route::get('/purchase', [FrontendController::class, 'getOrderHistory'])->name('user-order-history');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('user-add-to-cart');
    Route::get('/shopping-cart', [FrontendController::class, 'getCart'])->name('user-cart');
    Route::post('/handle-pay', [FrontendController::class, 'handlePay'])->name('user-handle-pay');
    Route::get('/checkout', [FrontendController::class, 'getPay'])->name('user-pay');
    Route::get('/checkout-by-cart', [FrontendController::class, 'getPayByCart'])->name('user-pay-by-cart');
    Route::get('/handle-checkout-by-cart', [CartController::class, 'handleCheckoutByCart'])->name('handle-checkout-by-cart');
    Route::post('/create-pay', [PayController::class, 'create'])->name('create-pay');
    Route::get('/create-pay-online', [PayController::class, 'createOrderWhenPaymentOnline'])->name('create-pay-online');
    Route::delete('{id}/delete-cart-item',[CartController::class,'delete'])->name('delete-cart-item');
    Route::get('/order-history',[FrontendController::class,'getOrderHistory'])->name('order-history');
    Route::get('{order_id}/cancle-order',[OrderController::class,'cancleOrder'])->name('cancle-order');
    Route::get('{order_id}/receive-order', [OrderController::class, 'receiveOrder'])->name('receive-order');
//    Route::get('payment-online', [PayController::class, 'paymentOnline'])->name('payment-online');
    Route::post('payment-online', [PayController::class, 'createPaymentOnline'])->name('create-payment-online');
    Route::get('handle-after-payment-online', [PayController::class, 'handleAfterPaymentOnline'])->name('handle-after-payment-online');
    Route::get('account-infor', [FrontendController::class, 'getInforCustomer'])->name('account-infor');
    Route::put('update-username', [CustomerController::class, 'updateUsername'])->name('update-username');
    Route::put('update-email', [CustomerController::class, 'updateEmail'])->name('update-email');
    Route::get('form-change-password', [CustomerController::class, 'formChangePassword'])->name('form-change-password');
    Route::put('update-password', [CustomerController::class, 'updatePassword'])->name('update-password');
});
Route::get('/{id}/product-detail', [FrontendController::class, 'getProductDetail'])->name('product-detail');