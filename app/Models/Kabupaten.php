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

    public function kecamatan(): HasMany
    {
        return $this->hasMany(Kecamatan::class);
    }
}
