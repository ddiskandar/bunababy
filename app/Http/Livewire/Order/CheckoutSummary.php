<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckoutSummary extends Component
{
    public function confirm()
    {
        $this->orderNow();
    }

    public function getNoReg()
    {
        $alphabet = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $phone = auth()->user()->profile->phone;
        $i = rand(1,26);
        $j = rand(1,26);
        return $alphabet[$i] . $alphabet[$j] . $phone;
    }

    public function orderNow()
    {
        $order = Order::create([
            'place' => session('order.place'),
            'client_user_id' => auth()->id(),
            'midwife_user_id' => session('order.midwife_user_id'),
            'address_id' => 1,
            'total_price' => $this->total_price(),
            'total_duration' => $this->total_duration(),
            'total_transport' => $this->total_transport(),
            'date' => session('order.date'),
            'start_time' => $this->start_time(),
            'end_time' => $this->end_time(),
            'status' => Order::STATUS_LOCKED,
            'invoice' => 'INV/' . session('order.date')->isoFormat('YYYYMMDD') . '/BBC/' . rand(111111, 999999),
            'no_reg' => $this->getNoReg(),
        ]);

        foreach ( collect(session('order.treatments')) as $treatment ) {
            $order->treatments()->attach(
                $treatment['treatment_id']
            );
        }

        session()->forget('order');

        return redirect()->route('home');

    }

    public function render()
    {
        return view('order.checkout-summary');
    }
}
