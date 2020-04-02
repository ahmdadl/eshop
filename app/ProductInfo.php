<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    protected $guarded = [];

    protected $casts = [
        'info' => 'array',
    ];
}
