<?php

namespace App\Http\Controllers\Midwife;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (auth()->user()->type !== UserType::MIDWIFE) {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        $schedules = auth()->user()->midwife?->orders;
        return view('midwife.dashboard', [
            'schedules' => $schedules,
        ]);
    }
}
