<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function categories() : HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function subCat() : HasMany
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
}
