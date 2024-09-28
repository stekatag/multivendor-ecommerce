<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
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
  });
