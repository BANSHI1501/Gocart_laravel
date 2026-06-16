<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $collection = 'products';
    
    protected $guarded = [];

    protected $casts = [
        'description' => 'array',
        'image' => 'array',
        'price' => 'float',
        'offerPrice' => 'float',
        'inStock' => 'boolean',
    ];
}
