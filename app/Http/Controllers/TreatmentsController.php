<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreatmentsController extends Controller
{
    public function __invoke()
    {
        return view('treatments.index');
    }
}
