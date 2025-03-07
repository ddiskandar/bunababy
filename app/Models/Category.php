<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
