<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'stock',
        'price',
        'promo_price',
        'image',
        'is_promo',
    ];

    protected $casts = [
        'is_promo' => 'boolean',   // ■ pastikan casting Boolean
        'price' => 'decimal:2',
        'promo_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
