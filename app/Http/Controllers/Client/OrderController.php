<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        if(auth()->check() AND ! auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if( auth()->check() AND (auth()->user()->latestReservation AND ! auth()->user()->latestReservation->paid())){
            return redirect('/me')->with('status', 'Anda masih punya order aktif yang belum dibayar!');
        }

        return view('client.order.step-1');
    }

    public function time()
    {
        if(auth()->check() AND ! auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if( session()->missing('order.midwife_user_id') OR session()->missing('order.place') OR session()->missing('order.kecamatan_id') OR session()->missing('order.date')) {
            return redirect()->route('order.step-1');
        }

        return view('client.order.step-2');
    }

    public function client()
    {
        if(auth()->check() AND ! auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if( session()->missing('order.midwife_user_id') OR session()->missing('order.place') OR session()->missing('order.kecamatan_id') OR session()->missing('order.date') OR session()->missing('order.start_time_id') OR session()->missing('order.treatments.0') ) {
            return redirect()->back();
        }

        return view('client.order.step-3');
    }

    public function show(Order $order)
    {
        return view('client.order.show', [
            'order' => $order,
        ]);
    }
}
