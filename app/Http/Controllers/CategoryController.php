<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('products')->orderBy('name');
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $categories = $query->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $products = $category->products()
            ->latest()
            ->paginate(12);

        return view('categories.show', [
            'category' => $category,
            'products' => $products
        ]);
    }
} 