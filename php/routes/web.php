<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\Products\BrandController;
use App\Http\Controllers\Products\UnitsController;
use App\Http\Controllers\Products\SupplierController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\PricingController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('products', ProductController::class)->names('products')->except(['create', 'show', 'edit']);
Route::group([
    'prefix' => 'products',
    'as' => 'products.',
    'middleware' => 'throttle.writes:20,1', // 20 attempts per minute only to write methods
], function () {
    Route::resource('categories', CategoryController::class)->names('categories')->except(['create', 'show', 'edit']);
    Route::resource('brands', BrandController::class)->names('brands')->except(['create', 'show', 'edit']);
    Route::resource('units', UnitsController::class)->names('units')->except(['create', 'show', 'edit']);
    Route::resource('suppliers', SupplierController::class)->names('suppliers')->except(['create', 'show', 'edit']);
    Route::resource('pricing', PricingController::class)->names('pricing')->except(['create', 'show', 'edit']);
});