<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

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

        if (session()->missing('order.kecamatan_id') or session()->missing('order.place') or session()->missing('order.date')) {
            return redirect()->route('order.create');
        }

        return view('client.order.cart');
    }
}
