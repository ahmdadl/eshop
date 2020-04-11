<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use Sluggable;

    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function subCat(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function subCatProducts(): HasMany
    {
        return $this->subCat()->with('products');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productsMini(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function products(): BelongsToMany
    {
        return $this->productsMini()->with(['rates', 'pi']);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path(string $parent_slug = ''): string
    {
        $path = '/' . app()->getLocale() . '/c/';
        if ($parent_slug === '') {
            return $path . $this->slug;
        }

        return $path . $parent_slug . '/sub/' . $this->slug;
    }
}
