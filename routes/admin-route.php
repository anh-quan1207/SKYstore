<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\VoucherController;
use App\Models\ProductVariant;

Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminController::class, 'getLogin'])->name('admin-form-login')->middleware('guest:admin');
    Route::post("/post-login", [AdminController::class, 'authenticate'])->name('admin-login')->middleware('guest:admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin-logout');
    // dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard')->middleware("auth:admin");
    // category
    Route::prefix('category')->middleware('auth:admin')->group(function () {
        Route::get('/list', [AdminController::class, 'getCategoryList'])->name('admin-category-list');
        Route::get('/form-create-category', [AdminController::class, 'getFormCreateCategory'])->name('admin-category-form-create');
        Route::post('/create', [AdminController::class, 'createCategory'])->name('admin-category-create');
        Route::get('/{id}/edit', [AdminController::class, 'getFormUpdateCategory'])->name('admin-category-form-update');
        Route::put('/update', [AdminController::class, 'updateCategory'])->name('admin-category-update');
        Route::delete('{id}/delete', [AdminController::class, 'deleteCategory'])->name('admin-category-delete');
    });
    // product
    Route::prefix('product')->middleware('auth:admin')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('admin-product-list');
        Route::get('/form-create-product', [ProductController::class, 'create'])->name('admin-product-form-create');
        Route::post('/create', [ProductController::class, 'store'])->name('admin-product-create');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('admin-product-form-update');
        Route::put('/update', [ProductController::class, 'update'])->name('admin-product-update');
        Route::delete('{id}/delete', [ProductController::class, 'delete'])->name('admin-product-delete');
        Route::get('{id}/images', [ProductController::class, 'getImage'])->name('admin-product-image');
        Route::get('{id}/images/create', [ProductController::class, 'createImage'])->name('admin-product-image-form');
        Route::post('{id}/images/create', [ProductController::class, 'storeImage'])->name('admin-product-image-create');
        Route::delete('/image/{id}/delete', [ProductController::class, 'deleteImage'])->name('admin-image-delete');
        Route::prefix('/{id}/product-variant')->group(function () {
            Route::get('/list', [ProductVariantController::class, 'index'])->name('admin-product-variant-list');
            Route::get('/create', [ProductVariantController::class, 'create'])->name('admin-product-variant-form-create');
            Route::post('/create', [ProductVariantController::class, 'store'])->name('admin-product-variant-create');
            Route::get('{product_variant_id}/edit', [ProductVariantController::class, 'edit'])->name('admin-product-variant-form-update');
            Route::put('{product_variant_id}/update', [ProductVariantController::class, 'update'])->name('admin-product-variant-update');
            Route::delete('{product_variant_id}/delete', [ProductVariantController::class, 'delete'])->name('admin-product-variant-delete');
        });
    });

    // customer
    Route::prefix('customer')->middleware('auth:admin')->group(function () {
        Route::get('/list', [CustomerController::class, 'index'])->name('admin-customer-list');
        Route::delete('/lock-account', [AdminController::class, 'lockAccount'])->name('admin-lock-account');
    });

    // voucher
    Route::prefix('voucher')->middleware('auth:admin')->group(function () {
        Route::get('/list', [VoucherController::class, 'index'])->name('admin-voucher-list');
        Route::get('/form-create-voucher', [VoucherController::class, 'create'])->name('admin-voucher-form-create');
        Route::post('/create', [VoucherController::class, 'store'])->name('admin-voucher-create');
        Route::delete('{id}/delete', [VoucherController::class, 'delete'])->name('admin-voucher-delete');
    });

    // order
    Route::prefix('order')->middleware('auth:admin')->group(function () {
        Route::get('/list', [OrderController::class, 'index'])->name('admin-order-list');
        Route::put('{id}/update', [OrderController::class, 'update'])->name('admin-order-update');
        Route::get('{id}/order-detail', [OrderController::class, 'getOrderDetail'])->name('admin-order-detail');
    });
});