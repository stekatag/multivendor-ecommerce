<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;

// Vendor routes
Route::middleware(['web', 'auth', 'role:vendor'])
  ->prefix('vendor')
  ->as('vendor.')
  ->group(function () {
    Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
    Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

    // Vendor shop profile
    Route::resource('shop-profile', VendorShopProfileController::class);

    // Product Route
    Route::get('product/get-subcategories', [VendorProductController::class, 'getSubcategories'])->name('product.get-subcategories');
    Route::get('product/get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('product.get-child-categories');
    Route::put('product/change-status', [VendorProductController::class, 'changeStatus'])->name('product.change-status');
    Route::resource('product', VendorProductController::class);
  });
