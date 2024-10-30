<?php

namespace App\Models;

use App\Enums\SlotPart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slot extends Model
{
    /** @use HasFactory<\Database\Factories\SlotFactory> */
    use HasFactory;

    protected $casts = [
        'part' => SlotPart::class,
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
