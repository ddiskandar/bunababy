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
        $age = $dob->diffInYears();
        $string = round($age) . ' tahun';
        if ($age <= 2) {
            $string = round($dob->diffInMonths()) . ' bulan';
        }
        return $string;
    }
}
