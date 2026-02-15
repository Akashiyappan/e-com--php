<?php

use App\Http\Controllers\ShopController;

Route::get('/', [ShopController::class, 'index']);
Route::post('/order', [ShopController::class, 'placeOrder']);
