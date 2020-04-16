<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use Sluggable;

    protected $guarded = [];

    protected $casts = [
        'is_used' => 'boolean',
        'color' => 'array',
        'img' => 'array'
    ];

    protected $with = ['rates'];

    protected $appends = [
        'rateAvg',
        'savedPrice'
    ];

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

    public function getRateAvgAttribute(): float
    {
        return round($this->rates->average('rate'), 1);
    }

    public function getSavedPriceAttribute(): float
    {
        return $this->price - ($this->save / 100 * $this->price);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function pCat(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_slug', 'slug')->with('parent');
    }

    public function pi(): HasOne
    {
        return $this->hasOne(ProductInfo::class);
    }

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function daily(): HasOne
    {
        return $this->hasOne(DailyDeal::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
