<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SesiController;

Route::middleware(['guest'])->group(function(){
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/product', function () {
        $user = Auth::user();
    
        if ($user->role === 'admin') {
            return redirect('/admin'); // langsung redirect tanpa method
        }
    
        return app(ProductController::class)->index(); // panggil method untuk customer
    })->name('dashboard');

    Route::get('/product', [ProductController::class, 'productRedirect'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'show'])->name('product.show');
    Route::get('/logout', [SesiController::class, 'logout']);
});

Route::get('/filament/login', function () {
    return redirect('/'); // redirect ke login custom
})->name('filament.admin.auth.login');

Route::match(['GET', 'POST'], '/filament/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('filament.auth.logout');
