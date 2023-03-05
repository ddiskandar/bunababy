<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Place;

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

        if (session()->missing('order.place_id') || session()->missing('order.date') || session()->missing('order.start_time_id') || session()->missing('order.treatments')) {
            return to_route('order.cart');
        }

        if (session('order.place_type') === Place::TYPE_HOMECARE && (session()->missing('order.kecamatan_id') || session()->missing('order.midwife_user_id'))) {
            return to_route('order.cart');
        }

        if (auth()->check() && session('order.place_type') === Place::TYPE_HOMECARE) {

            $address = auth()->user()->addresses->where('kecamatan_id', session('order.kecamatan_id'))->first();

            if ($address) {
                session()->put('order.address_id', $address->id);
            }
        }

        return view('client.order.checkout');
    }
}
