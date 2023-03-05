<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use App\Models\Place;
use App\Models\Slot;
use Carbon\Carbon;
use Livewire\Component;

class SelectClinicAvailableDate extends Component
{
    public $selectedMonth;
    public $slots;
    public $place;
    public $clinic;

    public function mount($clinic_id)
    {
        $this->selectedMonth = now()->format('Y-M');

        $this->slots = Slot::query()
            ->where('place_id', session('order.place_id'))
            ->get();

        $this->place = Place::find($place_id);
    }


    public function render()
    {
        $period = Carbon::parse($this->selectedMonth)
            ->startOfMonth()
            ->startOfWeek()
            ->DaysUntil(
                Carbon::parse($this->selectedMonth)
                    ->endOfMonth()
                    ->endOfWeek()
            );

        $schedules = Order::query()
            ->where('place_id', $this->place->id)
            ->whereBetween('start_datetime', [Carbon::parse($this->selectedMonth)->startOfMonth()->startOfWeek(), Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek()])
            ->locked()
            ->select('id', 'place_id', 'status', 'start_datetime', 'end_datetime')
            ->get();

        $data = collect();

        foreach ($period as $date) {
            $new = collect(['date' => $date]);

            foreach ($schedules as $order) {

                if ($order->start_datetime->format('m-d') == $date->format('m-d')) {
                    foreach ($this->slots as $slot) {
                        if (Carbon::parse($date->toDateString() . $slot->time)->between($order->start_datetime, $order->end_datetime)) {
                            $new->put($slot->time, 'booked');
                        } elseif ($new->has($slot->time)) {
                            //
                        } else {
                            $new->put($slot->time, 'empty');
                        }
                    }
                }
            }

            $new->put(
                'status',
                ($new->doesntContain('empty') and $new->doesntContain('booked'))
                    ? 'kosong'
                    : ($new->doesntContain('empty')
                        ? 'penuh'
                        : 'tersedia')
            );

            $data->push($new);
        }

        return view('client.order.select-clinic-available-date', [
            'data' => $data,
        ]);
    }
}
