<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    // Available payment methods grouped by category
    public static $paymentMethods = [
        'bank_transfer' => [
            'bca' => 'Bank BCA',
            'bni' => 'Bank BNI',
            'mandiri' => 'Bank Mandiri',
            'bri' => 'Bank BRI'
        ],
        'e_wallet' => [
            'dana' => 'DANA',
            'ovo' => 'OVO',
            'gopay' => 'GoPay',
            'shopeepay' => 'ShopeePay'
        ],
        'cod' => [
            'cod' => 'Cash on Delivery (COD)'
        ]
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Helper method to get payment method display name
    public function getPaymentMethodName(): string
    {
        foreach (self::$paymentMethods as $category) {
            if (isset($category[$this->payment_method])) {
                return $category[$this->payment_method];
            }
        }
        return ucfirst(str_replace('_', ' ', $this->payment_method));
    }

    // Helper method to get payment category display name
    public function getPaymentCategoryName(): string
    {
        $categories = [
            'bank_transfer' => 'Transfer Bank',
            'e_wallet' => 'E-Wallet',
            'cod' => 'Cash on Delivery'
        ];
        
        return $categories[$this->payment_category] ?? ucfirst(str_replace('_', ' ', $this->payment_category));
    }
} 