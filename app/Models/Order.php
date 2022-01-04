<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    const PLACE_CLIENT = 1;
    const PLACE_CLINIC = 2;

    const STATUS_UNPAID = 1;
    const STATUS_LOCKED = 2;
    const STATUS_FINISHED = 3;

    protected $casts = [
        'total_price' => 'integer',
        'total_duration' => 'integer',
        'total_transport' => 'integer',
        'total_fee_apd' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'integer',
    ];

    public function client(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'client_user_id');
    }

    public function midwife(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'midwife_user_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class)->withPivot('family_id');
    }


    public function paid()
    {
        return $this->payments->pluck('value')->sum()
            >= ( $this->total_price + $this->total_transport + $this->total_fee_apd );
    }

}
