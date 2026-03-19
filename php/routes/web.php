<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\Products\BrandController;
use App\Http\Controllers\Products\UnitsController;
use App\Http\Controllers\Products\SupplierController;
use App\Http\Controllers\Products\ListController;
use App\Http\Controllers\Products\PricingController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::resource('categories', CategoryController::class)->names('categories');
    Route::resource('brands', BrandController::class)->names('brands');
    Route::resource('units', UnitsController::class)->names('units');
    Route::resource('suppliers', SupplierController::class)->names('suppliers');
    Route::resource('list', ListController::class)->names('list');
    Route::resource('pricing', PricingController::class)->names('pricing');
});