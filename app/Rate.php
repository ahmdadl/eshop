<?php

namespace App;

use App\Events\MyEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    protected $guarded = [];

    protected $appends = [
        'updated'
    ];

    // public static function boot()
    // {
    //     parent::boot();

    //     Rate::created(function (Rate $rate) {
    //         event(new MyEvent($rate->id . ' is created'));
    //     });
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUpdatedAttribute() : string
    {
        return $this->updated_at ? $this->updated_at->diffForHumans() : '';
    }
}
