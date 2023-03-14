<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timetable extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPE_LEAVE = 1;    // libur, cuti
    const TYPE_OVERTIME = 2; // kerja lembur
    const TYPE_CLINIC = 3;    // Tugas di klinik

    protected $casts = [
        'date' => 'date',
    ];

    public function midwife(): BelongsTo
    {
        return $this->belongsTo(User::class, 'midwife_user_id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function getTypeString()
    {
        switch ($this->type) {
            case self::TYPE_LEAVE:
                return 'Libur';
                break;

            case self::TYPE_OVERTIME:
                return 'Lembur';
                break;

            default:
                return 'Klinik';
                break;
        }
    }
}
