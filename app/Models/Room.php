<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class, 'room_treatment', 'room_id', 'treatment_id');
    }
}
