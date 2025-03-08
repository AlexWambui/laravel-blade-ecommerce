<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Products\ProductCategoryController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\ProductImageController;

Route::view('/', 'index')->name('home-page');
Route::view('/about', 'about')->name('about-page');
Route::view('/services', 'services')->name('services-page');
Route::view('/contact', 'contact')->name('contact-page');
Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');

Route::middleware(['auth', 'verified', 'active'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['admin'])->group(function() {
        Route::resource('users', UserController::class)->except('show');

        Route::resource('messages', MessageController::class)->only('index', 'edit', 'destroy');

        Route::resource('product-categories', ProductCategoryController::class)->except('create', 'show');
        Route::resource('products', ProductController::class)->except('show');
        Route::resource('product-images', ProductImageController::class)->except('show');
        Route::get('/products/images/delete/{id}', [ProductController::class, 'deleteProductImage'])->name('products.delete_image');
        Route::post('/products/images/sort', [ProductController::class, 'sortProductImages'])->name('products.sort_images');
    });
});

require __DIR__.'/auth.php';
