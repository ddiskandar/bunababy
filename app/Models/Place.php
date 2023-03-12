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
        'type' => 'integer',
    ];

    protected $fillable = [
        'name',
        'desc',
        'type',
        'address',
        'order',
        'active',
    ];

    public function getTypeString()
    {
        switch ($this->type) {
            case self::TYPE_HOMECARE:
                return 'Homecare';
            case self::TYPE_CLINIC:
                return 'Klinik';
            default:
                return 'Tidak diketahui';
        }
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeClinics($query)
    {
        return $query->where('type', self::TYPE_CLINIC);
    }

    public function scopeOrderAsc($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
