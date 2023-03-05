<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index()
    {
        return view('testimonials.index');
    }

    public function show(Order $order)
    {
        if ($order->client_user_id !== auth()->id()) {
            return to_route('home');
        }

        return view('testimonials.show', [
            'reservation' => $order,
        ]);
    }
}
