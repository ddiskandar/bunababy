<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class OrderCheckController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        session()->put('order.status', 'newUser');
        return to_route('order.cart');
    }
}
