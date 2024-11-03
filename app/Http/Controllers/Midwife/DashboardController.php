<?php

namespace App\Http\Controllers\Midwife;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $schedules = auth()->user()->midwife->orders;
        return view('midwife.dashboard', [
            'schedules' => $schedules,
        ]);
    }
}
