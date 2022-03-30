<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function show()
    {
        return view('wilayah.show-kabupaten');
    }
}
