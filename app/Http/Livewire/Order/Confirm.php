<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Confirm extends Component
{
    public function confirm()
    {
        // sleep(2);
        // return back();
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
        DB::transaction(function(){

            $order = new Order();
            $order->no_reg = $this->getNoReg();
            $order->invoice = 'INV/' . session('order.date')->isoFormat('YYYYMMDD') . '/BBC/' . rand(111111, 999999);
            $order->place = session('order.place');
            $order->client_user_id = auth()->id();
            $order->midwife_user_id = session('order.midwife_user_id');
            $order->address_id = 31;
            $order->total_price = $order->getTotalPrice();
            $order->total_duration = $order->getTotalDuation();
            $order->total_transport = $order->getTotalTransport();
            $order->start_datetime = Carbon::parse(session('order.date')->toDateString() . ' ' . session('order.start_time'));
            $order->end_datetime = $order->start_datetime->addMinutes(session('order.addMinutes'));
            $order->status = Order::STATUS_LOCKED;
            $order->save();

            foreach ( collect(session('order.treatments')) as $treatment ) {
                $order->treatments()->attach(
                    $treatment['treatment_id']
                );
            }

            session()->forget('order');

            return redirect()->route('me');
        });

    }

    public function render()
    {
        return view('order.confirm');
    }
}
