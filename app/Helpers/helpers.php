<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if(!function_exists('objectStorageAsset')) {
    function objectStorageAsset($value)
    {
        return env('OBJECT_STORAGE_ASSET', 'https://is3.cloudhost.id/bunababycare/bunababycare/') . $value;
    }
}

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

if (!function_exists('tanggalIndo')) {
    function tanggalIndo($value)
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

if (!function_exists('toWaIndo')) {
    function toWaIndo($value)
    {
        if (substr($value, 0, 2) == '08') {
            return substr_replace($value, '62', 0, 1);
        } else {
            return $value;
        }
    }
}

if (!function_exists('calculateTransport')) {
    function calculateTransport($distance)
    {
        $transportCost = null;

        switch (true) {
            case $distance <= 2:
                $transportCost = 15000;
                break;
            case $distance <= 3:
                $transportCost = 18000;
                break;
            case $distance <= 5:
                $transportCost = 25000;
                break;
            case $distance <= 7:
                $transportCost = 30000;
                break;
            case $distance <= 9:
                $transportCost = 33000;
                break;
            case $distance <= 20:
                $transportCost = 38000;
                break;
            default:
                $transportCost = 40000;
                break;
        }

        return $transportCost;
    }
}

if (!function_exists('calculateAge')) {
    function calculateAge($dob)
    {
        $age = Carbon::parse($dob)->diffInYears();
        $string = $age . ' tahun';
        if ($age <= 2) {
            $string = Carbon::parse($dob)->diffInMonths() . ' bulan';
        }
        return $string;
    }
}
