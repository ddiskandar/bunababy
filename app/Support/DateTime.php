<?php

namespace App\Support;

use Illuminate\Support\Carbon;

class DateTime
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function calculateAge($dob) {
        $age = Carbon::parse($dob)->diffInYears();
        $string = $age . ' tahun';
        if ($age <= 2) {
            $string = Carbon::parse($dob)->diffInMonths() . ' bulan';
        }
        return $string;
    }
}
