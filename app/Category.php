<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
}
