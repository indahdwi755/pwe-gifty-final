<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('dashboard');
Route::get('/products', [ProductController::class, 'show'])->name('product.show');
