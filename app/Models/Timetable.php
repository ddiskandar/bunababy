<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $guarded = [];

    const OVERTIME = 1; // kerja lembur
    const LEAVE = 2;    // libur, cuti
    const CLINIC = 3;    // Tugas di klinik

    protected $casts = [
        'date' => 'date',
    ];

    public function midwife()
    {
        return $this->belongsTo(User::class, 'midwife_user_id');
    }

    public function type()
    {
        return $this->type == 1 ? 'Lembur' : ( $this->type == 2 ? 'Libur' : 'Klinik' );
    }

}
