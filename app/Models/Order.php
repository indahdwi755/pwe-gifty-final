<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Order extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'product_id',
        'transaction_id',
        'total_price',
        'status',
        'address',
    ];

    protected $attributes = [
        'status' => 'packing',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
