<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;

Route::get('dashboard', [AdminController::class,'dashboard'])->name('dashboard');

// profile Routes
Route::get('profile', [ProfileController::class,'index'])->name('profile');
Route::post('profile/update', [ProfileController::class,'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class,'updatePassword'])->name('password.update');


/** Slider Route */
Route::resource('slider', SliderController::class);

/** Category Route */
Route::put('change-status', [CategoryController::class,'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);
/** Sub Category Route */
Route::put('sub-category/change-status', [SubCategoryController::class,'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);
Route::put('child-category/change-status', [SubCategoryController::class,'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

/** brand Route */

Route::put('brand/change-status', [BrandController::class,'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

Route::resource('vendor-profile', AdminVendorProfileController::class);

// product route 

Route::put('product/change-status', [ProductController::class,'changeStatus'])->name('products.change-status');
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-childcategories', [ProductController::class, 'getChildCategories'])->name('product.get-childcategories');
Route::resource('products', ProductController::class);
