<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('client.order.jadwal');
    }

    public function time()
    {
        if( session()->missing('order.midwife_user_id')
            OR session()->missing('order.place')
            OR session()->missing('order.kecamatan_id')
            OR session()->missing('order.date')
        ) {
            return redirect()->route('client.order');
        }

        return view('client.order.waktu');
    }

    public function client()
    {
        if( session()->missing('order.midwife_user_id')
            OR session()->missing('order.place')
            OR session()->missing('order.kecamatan_id')
            OR session()->missing('order.date')
            OR session()->missing('order.start_time_id')
            OR session()->missing('order.treatments.0')
        ) {
            return redirect()->back();
        }

        return view('client.order.pemesan');
    }

    public function show(Order $order)
    {
        return view('client.order.show', [
            'order' => $order,
        ]);
    }
}
