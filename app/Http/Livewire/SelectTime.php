<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SelectTime extends Component
{
    public function selectTime(Slot $slot)
    {
        session(['start_time_id' => $slot->id]);

        $this->emit('timeChanged');
    }

    public function render()
    {
        $orders = Order::query()
            ->where('date', session('selectedDate'))
            ->where('midwife_user_id', session('midwife_user_id'))
            ->select('id', 'start_time', 'end_time')
            ->get();

        $slots = DB::table('slots')->get();
        $data = collect();

        foreach ($slots as $slot) {
            $new = collect(['id'=> $slot->id]);
            $new->put('time', $slot->time);
            foreach ($orders as $order) {
                if ( Carbon::parse($slot->time)->between(Carbon::parse($order->start_time), Carbon::parse($order->end_time))) {
                    $new->put($order->id, 'booked');
                } else { $new->put($order->id, 'empty'); }
            }
            $new->put('status', ($new->contains('booked')) ? 'booked' : 'empty');

            $data->push($new);
        }
        // dd($data);

        return view('livewire.select-time', [
            'slots' => $slots,
            'data' => $data,
        ]);
    }
}
