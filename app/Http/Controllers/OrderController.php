<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function myOrders()
    {
        $orders = Order::with(['product', 'payment'])
                      ->where('user_id', auth()->id())
                      ->latest()
                      ->get();

        return view('orders.my', compact('orders'));
    }

    public function create(Request $request, Product $product)
    {
        return view('orders.create', [
            'product' => $product
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id'     => 'required|exists:products,id',
            'customer_name'  => 'required|string|max:255',
            'address'        => 'required|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $order = Order::create([
            'user_id'       => auth()->id(),
            'customer_name' => $validated['customer_name'],
            'product_id'    => $product->id,
            'total_price'   => $product->price,
            'address'       => $validated['address'],
            'status'        => Order::STATUS_PENDING
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Silakan lanjutkan ke pembayaran.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}
