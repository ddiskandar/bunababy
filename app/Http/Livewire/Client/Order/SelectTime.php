<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use App\Models\Place;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SelectTime extends Component
{
    protected $listeners = [
        'treatmentAdded' => '$refresh',
        'treatmentDeleted' => '$refresh',
    ];

    public function mount()
    {
        if (auth()->check()) {
            session()->put('order.status', 'authUser');
        }
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
            ->when(session('order.place_type') === Place::TYPE_HOMECARE, function ($query) {
                return $query->where('midwife_user_id', session('order.midwife_user_id'));
            })
            ->when(session('order.place_type') === Place::TYPE_CLINIC, function ($query) {
                return $query->where('place_id', session('order.place_id'))
                    ->where('room_id', session('order.room_id')); // TODO: add room_id to session
            })
            ->whereDate('date', session('order.date'))
            ->locked()
            ->with('place')
            // ->select('id', 'startDateTime', 'endDateTime')
            ->get();

        $slots = DB::table('slots')->where('place_id', session('order.place_id'))->orderBy('time')->get();

        $data = collect([]);

        foreach ($slots as $slot) {
            $new = collect(['id' => $slot->id]);
            $new->put('time', $slot->time);
            foreach ($orders as $order) {
                if (Carbon::parse(session('order.date')->toDateString() . $slot->time)->between($order->startDateTime, $order->endDateTime->addMinutes($order->place->transport_duration))) {
                    $new->put($order->id, 'booked');
                } else {
                    $new->put($order->id, 'empty');
                }
            }
            $new->put('status', ($new->contains('booked')) ? 'booked' : 'empty');
            $new->put('slot', Carbon::parse($slot->time)->gte(Carbon::parse('12:00:00')) ? 'siang' : 'pagi');

            $data->push($new);
        }

        $data = $data->groupBy(function ($slot) {
            if ($slot['slot'] === 'pagi') {
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
