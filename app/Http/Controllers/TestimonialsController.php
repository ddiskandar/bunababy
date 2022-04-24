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
        if ($order->client_user_id != auth()->id())
        {
            return to_route('me');
        }

        return view('testimonials.show', [
            'reservation' => $order,
        ]);
    }

    public function create(Order $order)
    {
        if ($order->client_user_id != auth()->id())
        {
            return to_route('me');
        }

        if ($order->testimonial()->exists())
        {
            return to_route('testimonial.show', $order->no_reg);
        }

        return view('testimonials.create', [
            'reservation' => $order,
        ]);
    }
}
