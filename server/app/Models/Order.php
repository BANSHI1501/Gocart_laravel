<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $collection = 'orders';

    protected $guarded = [];

    protected $casts = [
        'items' => 'array',
        'amount' => 'float',
        'isPaid' => 'boolean',
    ];
}
