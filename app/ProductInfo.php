<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    protected $guarded = [];

    protected $casts = [
        'info' => 'array',
    ];

    public function getMiniInfoAttribute(): array
    {
        $arr = $this->info;
        return array_splice($arr, 0, 4);
    }
}
