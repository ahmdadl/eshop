<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
