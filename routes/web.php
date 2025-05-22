<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;

// === Tambahan penting ===
Route::get('/login', [SesiController::class, 'index'])->name('login');
Route::post('/login', [SesiController::class, 'login']);

// Guest Routes
Route::middleware(['guest'])->group(function(){
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

// Auth Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', function() {
        return redirect()->route('dashboard');
    });

    Route::get('/product', [ProductController::class, 'productRedirect'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'allProducts'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/all-products', [ProductController::class, 'allProductsPage'])->name('products.all');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/orders/create/{product}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/payments/create/{order}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');

    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
});

// Filament Routes
Route::get('/filament/login', function () {
    return redirect('/');
})->name('filament.admin.auth.login');

Route::match(['GET', 'POST'], '/filament/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('filament.auth.logout');

