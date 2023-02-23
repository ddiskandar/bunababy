<?php

namespace App\Http\Controllers;

class TreatmentCategoriesController extends Controller
{
    public function __invoke()
    {
        return view('treatments.show-categories');
    }
}
