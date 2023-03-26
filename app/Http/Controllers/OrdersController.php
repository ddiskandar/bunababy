<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function create()
    {
        return view('orders.create');
    }

    public function show($no_reg)
    {
        $order = Order::where('no_reg', $no_reg)->select('id', 'start_datetime')->firstOrFail();

        return view('orders.show', [
            'order' => $order
        ]);
    }
}
