<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        return view('wilayah.index');
    }
}
