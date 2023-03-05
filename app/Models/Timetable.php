<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timetable extends Model
{
    use HasFactory;

    protected $guarded = [];

    const LEAVE = 1;    // libur, cuti
    const OVERTIME = 2; // kerja lembur
    const CLINIC = 3;    // Tugas di klinik

    protected $casts = [
        'date' => 'date',
    ];

    public function midwife(): BelongsTo
    {
        return $this->belongsTo(User::class, 'midwife_user_id');
    }

    public function type()
    {
        return $this->type == 1 ? 'Libur' : ($this->type == 2 ? 'Lembur' : 'Klinik');
    }
}
