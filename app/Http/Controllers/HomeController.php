<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        if(auth()->check() && ! auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        $hasAddress = isset(auth()->user()->address);
        $hasPhone = isset(auth()->user()->profile->phone);
        $profileCompleted = ($hasPhone AND $hasAddress);

        $reservation = '';

        if ($profileCompleted)
        {
            $reservation = auth()->user()->latestReservation;
        }

        return view('client.me', [
            'hasAddress' => $hasAddress,
            'hasPhone' => $hasPhone,
            'profileCompleted' => $profileCompleted,
            'reservation' => $reservation,
        ]);
    }
}
