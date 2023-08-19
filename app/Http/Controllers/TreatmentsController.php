<?php

namespace App\Http\Controllers;

class TreatmentsController extends Controller
{
    public function __invoke()
    {
        return view('treatments.index');
    }
}
