<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kabupaten extends Model
{
    /** @use HasFactory<\Database\Factories\KabupatenFactory> */
    use HasFactory;

    protected $casts = [
        'active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function kecamatan(): HasMany
    {
        return $this->hasMany(Kecamatan::class);
    }
}
