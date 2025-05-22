<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        return view('payments.create', compact('order'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|in:transfer_bank,e_wallet',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total_price,
            'payment_method' => $validated['payment_method'],
            'status' => 'paid' 
        ]);

        $order->update(['status' => 'processing']);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }
} 