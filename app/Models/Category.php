<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }
}
