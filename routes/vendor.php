<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
// Vendor routes
Route::middleware(['web', 'auth', 'role:vendor'])
  ->prefix('vendor')
  ->as('vendor.')
  ->group(function () {
    Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
  });
