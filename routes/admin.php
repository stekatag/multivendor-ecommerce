<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubcategoryController;

// Admin routes
Route::middleware(['web', 'auth', 'role:admin'])
  ->prefix('admin')
  ->as('admin.')
  ->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Profile Routes
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Slider Route
    Route::resource('slider', SliderController::class);

    // Category Route
    Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
    Route::resource('category', CategoryController::class);

    // Subcategory Route
    Route::put('subcategory/change-status', [SubcategoryController::class, 'changeStatus'])->name('subcategory.change-status');
    Route::resource('subcategory', SubcategoryController::class);

    // Child Category Route
    Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
    Route::get('get-subcategories', [ChildCategoryController::class, 'getSubcategories'])->name('get-subcategories');
    Route::resource('child-category', ChildCategoryController::class);

    // Brand Route
    Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
    Route::resource('brand', BrandController::class);

    // Vendor Profile Route
    Route::resource('vendor-profile', AdminVendorProfileController::class);

    // Product Route
    Route::get('product/get-subcategories', [ProductController::class, 'getSubcategories'])->name('product.get-subcategories');
    Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
    Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
    Route::resource('product', ProductController::class);

    // Product Image Gallery Route
    Route::resource('product-image-gallery', ProductImageGalleryController::class);

    // Product Variant Route
    Route::put('product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
    Route::resource('product-variant', ProductVariantController::class);

    // Product Variant Item Route
    Route::get('product-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');
    Route::get('product-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');
    Route::post('product-variant-item', [ProductVariantItemController::class, 'store'])->name('product-variant-item.store');
    Route::get('product-variant-item/edit/{id}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
    Route::put('product-variant-item/{id}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');
    Route::delete('product-variant-item/{id}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');
  });
