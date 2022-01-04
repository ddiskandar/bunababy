<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    const STATUS_UNVERIFIED = 1;
    const STATUS_VERIFIED = 2;
    const STATUS_REJECTED = 3;

    protected $casts = [
        'value' => 'integer',
        'status' => 'integer',
        'verified_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function verificator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by_id');
    }

}
