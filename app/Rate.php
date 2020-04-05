<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    protected $guarded = [];

    protected $appends = [
        'updated'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUpdatedAttribute() : string
    {
        return $this->updated_at->format('d M Y');
    }
}
