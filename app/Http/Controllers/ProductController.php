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
            return redirect('/admin');
        }

        return $this->index();
    }

    public function index()
    {
        try {
            $products = Product::with('category')  
                        ->whereNotNull('name')     
                        ->whereNotNull('price')    
                        ->latest()
                        ->take(10)                 
                        ->get();

            $promos = Product::with('category')    
                        ->where('is_promo', true)
                        ->whereNotNull('price')     
                        ->whereNotNull('promo_price') 
                        ->latest()
                        ->take(5)                    
                        ->get();

            return view('products.index', [
                'products' => $products,
                'promos' => $promos,
                'is_all_products' => false
            ]);
        } catch (\Exception $e) {
            return view('products.index', [
                'products' => collect([]),
                'promos' => collect([]),
                'error' => 'Terjadi kesalahan saat memuat produk.',
                'is_all_products' => false
            ]);
        }
    }

    public function allProducts()
    {
        try {
            $products = Product::with('category')
                        ->whereNotNull('name')
                        ->whereNotNull('price')
                        ->latest()
                        ->get(); 
            return view('products.index', [
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return view('products.index', [
                'products' => collect([]),
                'error' => 'Terjadi kesalahan saat memuat produk.'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::with('category')->find($id);
            
            if (!$product) {
                return redirect()
                    ->route('products.index')
                    ->with('error', 'Produk tidak ditemukan');
            }
            
            return view('products.show', compact('product'));
        } catch (\Exception $e) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Terjadi kesalahan saat memuat produk');
        }
    }

    public function allProductsPage()
    {
        try {
            $products = Product::with('category')
                        ->whereNotNull('name')
                        ->whereNotNull('price')
                        ->latest()
                        ->paginate(12);
            return view('products.all-products', [
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return view('products.all-products', [
                'products' => collect([]),
                'error' => 'Terjadi kesalahan saat memuat produk.'
            ]);
        }
    }
}

