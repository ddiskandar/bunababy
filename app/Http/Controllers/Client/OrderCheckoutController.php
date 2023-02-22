<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class OrderCheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        if (auth()->check() && !auth()->user()->isClient()) {
            return to_route('dashboard');
        }

        if (session()->missing('order.kecamatan_id') or session()->missing('order.place') or session()->missing('order.date') or session()->missing('order.start_time_id') or session()->missing('order.treatments')) {
            return to_route('order.cart');
        }

        if (auth()->check()) {

            $address = auth()->user()->addresses->where('kecamatan_id', session('order.kecamatan_id'))->first();

            if ($address) {
                session()->put('order.address_id', $address->id);
            }
        }

        return view('client.order.checkout');
    }
}
