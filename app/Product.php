<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_used' => 'boolean',
        'color' => 'array',
        'img' => 'array'
    ];

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function pi() : HasOne
    {
        return $this->hasOne(ProductInfo::class);
    }
}
