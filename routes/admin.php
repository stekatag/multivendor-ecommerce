<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
// Admin routes
Route::middleware(['web', 'auth', 'role:admin'])
  ->prefix('admin')
  ->as('admin.')
  ->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
  });
