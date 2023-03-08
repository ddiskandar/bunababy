<?php

namespace App\Http\Controllers;

use App\Models\Place;

class PlaceController extends Controller
{
    public function index()
    {
        return view('places.index');
    }

    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }
}
