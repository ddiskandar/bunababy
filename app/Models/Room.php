<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
