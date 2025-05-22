<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'customer_name',
        'address',
        'total_price',
        'status'
    ];

    // Order status constants
    const STATUS_PENDING    = 'pending';
    const STATUS_PAID       = 'paid';
    const STATUS_PROCESSING = 'processing';
    const STATUS_PACKING    = 'packing';
    const STATUS_SHIPPED    = 'shipped';
    const STATUS_DELIVERED  = 'delivered';

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING    => 'Pending',
            self::STATUS_PAID       => 'Paid',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_PACKING    => 'Packing',
            self::STATUS_SHIPPED    => 'Shipped',
            self::STATUS_DELIVERED  => 'Delivered',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($order) {
            if (!in_array($order->status, array_keys(self::getStatuses()))) {
                throw new \InvalidArgumentException('Invalid order status');
            }
        });
    }

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
