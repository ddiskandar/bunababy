<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    const TYPE_HOMECARE = 1;
    const TYPE_CLINIC = 2;

    use HasFactory;

    protected $casts = [
        'active' => 'boolean',
        'add_transport' => 'boolean',
        'type' => 'integer',
    ];

    protected $fillable = [
        'name',
        'desc',
        'add_transport',
        'type',
        'address',
        'order',
        'active',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrderAsc($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
