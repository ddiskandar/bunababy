<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function __invoke()
    {
        return view('wilayah.show-kabupaten');
    }
}
