<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('rupiah')) {
    function rupiah($value)
    {
        $isNegative = false;
        if ($value < 0) {
            $isNegative = true;
        }
        return ($isNegative ? '-Rp' : 'Rp') . number_format(abs($value), 0, ',', '.');
    }
}

if (!function_exists('tanggal')) {
    function tanggal($value)
    {
        return $value->isoFormat('dddd, D MMMM G');
    }
}

if (!function_exists('tanggal_indo')) {
    function tanggal_indo($value)
    {
        return $value->isoFormat('D MMMM G');
    }
}

if (!function_exists('waktu')) {
    function waktu($value)
    {
        return Str::substr($value, 0, 5);
    }
}

if (!function_exists('to_wa_indo')) {
    function to_wa_indo($value)
    {
        if (substr($value, 0, 2) == '08') {
            return substr_replace($value, '62', 0, 1);
        } else {
            return $value;
        }
    }
}

if (!function_exists('calculate_transport')) {
    function calculate_transport($distance)
    {
        if ($distance <= 2) {
            return 15000;
        } elseif ($distance <= 3) {
            return 18000;
        } elseif ($distance <= 5) {
            return 25000;
        } elseif ($distance <= 7) {
            return 30000;
        } elseif ($distance <= 9) {
            return 33000;
        } elseif ($distance <= 20) {
            return 38000;
        } else {
            return 40000;
        }
    }
}

if (!function_exists('calculate_age')) {
    function calculate_age($dob)
    {
        $age = Carbon::parse($dob)->diffInYears() . ' tahun';
        if ($age <= 2) {
            $age = Carbon::parse($dob)->diffInMonths() . ' bulan';
        }
        return $age;
    }
}
