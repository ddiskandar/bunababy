<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function show()
    {
        if(auth()->user()->isClient()) {
            return redirect()->route('me');
        }

        return view('calendar.index');
    }
}
