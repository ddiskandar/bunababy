<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (auth()->check() && !auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        $hasAddress = isset(auth()->user()->address);
        $hasPhone = isset(auth()->user()->profile->phone);
        $profileCompleted = ($hasPhone and $hasAddress);

        $reservation = '';

        if ($profileCompleted) {
            $reservation = auth()->user()->latestReservation;
        }

        return view('client.home', [
            'hasAddress' => $hasAddress,
            'hasPhone' => $hasPhone,
            'profileCompleted' => $profileCompleted,
            'reservation' => $reservation,
            'phone' => DB::table('options')->select('phone')->first()->phone
        ]);
    }
}
