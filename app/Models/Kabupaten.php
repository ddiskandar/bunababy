<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kabupaten extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'active' => 'boolean',
    ];

    public function kecamatans(): HasMany
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
