<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\Products\BrandController;
use App\Http\Controllers\Products\UnitsController;
use App\Http\Controllers\Products\ProductController;

use App\Http\Controllers\Suppliers\SupplierController;
use App\Http\Controllers\Suppliers\PricingController as SupplierPricingController;
use App\Http\Controllers\Suppliers\SuppliersProductController;

use App\Http\Controllers\Shops\ShopController;
use App\Http\Controllers\Shops\StaffController;
use App\Http\Controllers\Shops\PurchaseOrderController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group([
    'middleware' => 'throttle.writes:20,1', // 20 attempts per minute only to write methods
], function () {
    Route::resource('products', ProductController::class)->names('products')->except(['create', 'show', 'edit']);
    Route::group([
        'prefix' => 'products',
        'as' => 'products.',
    ], function () {
        Route::resource('categories', CategoryController::class)->names('categories')->except(['create', 'show', 'edit']);
        Route::resource('brands', BrandController::class)->names('brands')->except(['create', 'show', 'edit']);
        Route::resource('units', UnitsController::class)->names('units')->except(['create', 'show', 'edit']);
    });
    
    Route::resource('suppliers', SupplierController::class)->names('suppliers')->except(['create', 'edit']);
    Route::group([
        'prefix' => 'suppliers/{supplier}',
        'as' => 'suppliers.'
    ], function () {
        Route::resource('pricing', SupplierPricingController::class)->names('pricing')->except(['create', 'show', 'edit']);
        Route::resource('product', SuppliersProductController::class)->names('product')->except(['create', 'show', 'edit', 'update']);
    });

    Route::resource('shops', ShopController::class)->names('shops');
    Route::group([
        'prefix' => 'shops/{shop}',
        'as' => 'shops.'
    ], function () {
        Route::resource('staffs', StaffController::class)->names('staffs');
        Route::resource('purchase-orders', PurchaseOrderController::class)->names('purchase-orders')->except(['create', 'show', 'edit']);
    });
});
