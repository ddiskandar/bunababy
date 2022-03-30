<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        return view('wilayah.index');
    }
}
