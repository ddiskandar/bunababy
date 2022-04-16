<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        if (!auth()->user()->isClient())
        {
            return redirect('/dashboard');
        }

        $reservation = auth()->user()->latestReservation;


        return view('client.home', [
            'reservation' => $reservation,
        ]);
    }
}
