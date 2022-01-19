<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Slot;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PlaygroundController extends Controller
{
    public function index()
    {
        $selectedMonth = now()->format('Y-M');
        $selectedMonth = Carbon::parse($selectedMonth)->addMonth()->format('Y-M');
        $selectedMonth = Carbon::parse($selectedMonth)->addMonth()->format('Y-M');
        // $selectedMonth = Carbon::parse($selectedMonth)->subMonth()->format('Y-M');

        $period = Carbon::parse($selectedMonth)->startOfMonth()->startOfWeek()->DaysUntil(Carbon::parse($selectedMonth)->endOfMonth()->endOfWeek());

        $slots = Slot::all();
        $orders = Order::all();
        $data = collect();

        foreach ($period as $date) {
            $new = collect(['date' => $date]);
            foreach($orders as $order) {
                if ( $order->date->format('m-d') === $date->format('m-d') ) {
                    foreach($slots as $slot){
                        if ( Carbon::parse($slot->time)->between(Carbon::parse($order->start_time), Carbon::parse($order->end_time)) ) {
                            $new->put($slot->time, 'booked');
                        } else { $new->put($slot->time, 'empty'); }
                    }
                }
            }

            $new->put(
                'status',
                ($new->doesntContain('empty') AND $new->doesntContain('booked'))
                ? 'kosong'
                : ( $new->doesntContain('empty')
                    ? 'penuh'
                    : 'tersedia'));

            $data->push($new);
        }

        return view('playground', [
            'data' => $data,
            'selectedMonth' => $selectedMonth,
        ]);
    }
}
