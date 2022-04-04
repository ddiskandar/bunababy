<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'distance' => 'integer',
    ];

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function address(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function midwives(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'kecamatan_user', 'kecamatan_id', 'midwife_user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
