<?php

namespace App\Support;

class FormatNumber
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function toWaIndo($value)
    {
        if (substr($value, 0, 2) == '08') {
            return substr_replace($value, '62', 0, 1);
        } else {
            return $value;
        }
    }
}
