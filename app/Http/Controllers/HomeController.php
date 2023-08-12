<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (auth()->check() && ! auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        $hasAddress = isset(auth()->user()->address);
        $hasPhone = isset(auth()->user()->profile->phone);
        $profileCompleted = ($hasPhone and $hasAddress);

        $reservation = null;

        if ($profileCompleted) {
            $reservation = auth()->user()->latestReservation;
        }

        $options = DB::table('options')->select(['phone', 'site_name', 'site_location', 'ig'])->first();

        return view('client.home', [
            'hasAddress' => $hasAddress,
            'hasPhone' => $hasPhone,
            'profileCompleted' => $profileCompleted,
            'reservation' => $reservation,
            'phone' => $options->phone,
            'site_name' => $options->site_name,
            'site_location' => $options->site_location,
            'ig' => $options->ig,
        ]);
    }
}
