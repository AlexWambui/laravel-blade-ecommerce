<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Products\ProductCategoryController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\ProductImageController;
use App\Http\Controllers\GeneralPagesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Sales\SaleController;
use App\Http\Controllers\Deliveries\DeliveryLocationController;
use App\Http\Controllers\Deliveries\DeliveryAreaController;

Route::get('/', [GeneralPagesController::class, 'home'])->name('home-page');
Route::get('/shop', [GeneralPagesController::class, 'shop'])->name('shop-page');
Route::view('/contact', 'contact')->name('contact-page');
Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/update/{product_id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout', [SaleController::class, 'checkoutCreate'])->name('checkout.create');
Route::post('/checkout', [SaleController::class, 'checkoutStore'])->name('checkout.store');
Route::get('/checkout/success', [SaleController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/areas/fetch/{areaId}', [DeliveryAreaController::class, 'getAreas'])->name('get_areas');
Route::get('/areas/shipping-price/{areaId}', [DeliveryAreaController::class, 'getShippingPrice'])->name('get_shipping_price');

Route::get('/product/details/{slug}', [ProductController::class, 'show'])->name('products.details');
Route::get('/products/category/{category_slug}', [ProductController::class, 'categorizedProducts'])->name('products.categorized');
Route::get('/products/search', [ProductController::class, 'search_products'])->name('products.search');

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

        Route::resource('sales', SaleController::class)->except('create', 'show');

        Route::resource('locations', DeliveryLocationController::class)->except('create', 'show');
        Route::resource('areas', DeliveryAreaController::class)->except('create', 'show');
    });
});

require __DIR__.'/auth.php';
