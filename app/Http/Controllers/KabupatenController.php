<?php

namespace App\Http\Controllers;

class KabupatenController extends Controller
{
    public function __invoke()
    {
        return view('wilayah.show-kabupaten');
    }
}
