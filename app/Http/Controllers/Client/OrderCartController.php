<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Place;

class OrderCartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        if (auth()->check() && !auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if (auth()->check()) {
            session()->put('order.status', 'AuthUser');
        }

        if (session()->missing('order.place_type') || session()->missing('order.place_id') || session()->missing('order.date')) {
            return redirect()->route('order.create');
        }

        if (session('order.place_type') === Place::TYPE_HOMECARE && session()->missing('order.kecamatan_id')) {
            return redirect()->route('order.create');
        }

        return view('client.order.cart');
    }
}
