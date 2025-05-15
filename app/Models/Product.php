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
        'image',
        'is_promo',
    ];

    protected $casts = [
        'is_promo' => 'boolean',   // ■ pastikan casting Boolean
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
