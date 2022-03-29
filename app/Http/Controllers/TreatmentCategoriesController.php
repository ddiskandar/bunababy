<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreatmentCategoriesController extends Controller
{
    public function show()
    {
        return view('treatments.show-categories');
    }
}
