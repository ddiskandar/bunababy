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
