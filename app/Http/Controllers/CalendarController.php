<?php

namespace App\Http\Controllers;

class CalendarController extends Controller
{
    public function show()
    {
        return view('calendar.index');
    }
}
