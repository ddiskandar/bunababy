<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        abort_if(Auth::user()->isClient(), 403);

        return view('orders.index');
    }

    public function create()
    {
        abort_if(Auth::user()->isClient(), 403);

        return view('orders.create');
    }

    public function show(Order $order)
    {
        abort_if(Auth::user()->isClient(), 403);

        return view('orders.show', [
            'order' => $order
        ]);
    }
}
