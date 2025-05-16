<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{
    public function productRedirect()
{
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect('/admin'); // Panel admin Filament
    }

    return $this->index(); // Menampilkan produk untuk customer
}


    public function index()
{
    $products = Product::latest()->paginate(12); // Semua produk
    $promos   = Product::where('is_promo', true)  // Hanya produk promo
                       ->latest()
                       ->take(3)
                       ->get();               

    return view('products.index', compact('products', 'promos'));
}
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}

