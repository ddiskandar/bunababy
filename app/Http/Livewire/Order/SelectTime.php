<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SelectTime extends Component
{
    protected $listeners = ['treatmentAdded', 'treatmentDeleted'];

    public function treatmentAdded()
    {
        $this->render();
    }

    public function treatmentDeleted()
    {
        $this->render();
    }

    public function selectTime(Slot $slot)
    {
        session()->put('order.start_time', $slot->time);

        session()->put('order.start_time_id', $slot->id);

        $this->emit('timeChanged');
    }

    public function render()
    {
        $orders = Order::query()
            ->where('midwife_user_id', session('order.midwife_user_id'))
            ->whereDate('start_datetime', session('order.date'))
            ->select('id', 'start_datetime', 'end_datetime')
            ->get();

        $slots = DB::table('slots')->get();
        $data = collect();

        foreach ($slots as $slot) {
            $new = collect(['id'=> $slot->id]);
            $new->put('time', $slot->time);
            foreach ($orders as $order) {
                if ( Carbon::parse(session('order.date')->toDateString().$slot->time)->between($order->start_datetime, $order->end_datetime)) {
                    $new->put($order->id, 'booked');
                } else { $new->put($order->id, 'empty'); }
            }
            $new->put('status', ($new->contains('booked')) ? 'booked' : 'empty');
            $new->put('slot', Carbon::parse($slot->time)->gte(Carbon::parse('12:00:00')) ? 'siang' : 'pagi');

            $data->push($new);
        }
        $data = $data->groupBy(function ($slot) {
            if ($slot['slot'] == 'pagi') {
                return 'pagi';
            }
            return 'siang';
        });

        return view('client.order.select-time', [
            'slots' => $slots,
            'data' => $data,
        ]);
    }
}
