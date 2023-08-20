<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    const MAIN_ADDRESS = 1;

    protected $casts = [
        'is_main' => 'boolean',
    ];

    protected $guarded = [];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_user_id');
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function getFullAddressAttribute(): string
    {
        return $this->address
            . " Desa/Kel. "
            . $this->desa
            . " Kec. "
            . $this->kecamatan->name
            . " "
            . $this->kecamatan->kabupaten->name
            ;
    }

    public function scopeMainAddress($query)
    {
        return $query->where('is_main', true);
    }
}
