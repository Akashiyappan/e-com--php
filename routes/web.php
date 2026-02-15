<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Public shop routes
Route::get('/', [ShopController::class, 'index']);
Route::post('/order', [ShopController::class, 'placeOrder']);

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/order/{id}', [AdminController::class, 'orderDetails'])->name('admin.order-details');
});
