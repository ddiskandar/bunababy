<?php

if(!function_exists('rupiah')) {
    function rupiah($value)
    {
        return 'Rp' . number_format($value, 0 , ',' , '.');
    }
}

if(!function_exists('tanggal')) {
    function tanggal($value)
    {
        return $value->isoFormat('dddd, D MMMM G');
    }
}

if(!function_exists('tanggal_indo')) {
    function tanggal_indo($value)
    {
        return $value->isoFormat('D MMMM G');
    }
}

if(!function_exists('waktu')) {
    function waktu($value)
    {
        return \Str::substr($value, 0, 5 );
    }
}

if(!function_exists('to_wa_indo')) {
    function to_wa_indo($value)
    {
        if(substr($value, 0, 2) == '08'){
            return substr_replace($value, '62', 0, 1);
        } else {
            return $value;
        }

    }
}

