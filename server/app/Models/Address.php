<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Address extends Model
{
    protected $collection = 'addresses';

    protected $guarded = [];
}
