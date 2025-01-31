<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::view('/', 'index')->name('home-page');
Route::view('/about', 'about')->name('about-page');
Route::view('/services', 'services')->name('services-page');
Route::view('/contact', 'contact')->name('contact-page');

Route::middleware(['auth', 'verified', 'active'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
