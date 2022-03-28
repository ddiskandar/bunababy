<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    const OVERTIME = 1; // kerja lembur
    const LEAVE = 2;    // libur, cuti

}
