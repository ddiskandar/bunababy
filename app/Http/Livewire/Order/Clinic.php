<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\Slot;
use Carbon\Carbon;
use Livewire\Component;

class Clinic extends Component
{
    public $selectedMonth;
    public $slots;

    public function mount() {
        $this->selectedMonth = now()->format('Y-M');
        $this->slots = Slot::all();
    }

    public function prevMonth() {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)
            ->subMonth()
            ->format('Y-M');
    }

    public function nextMonth() {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)
            ->addMonth()
            ->format('Y-M');
    }

    public function selectDate($d, $m, $y) {
        if(session()->missing('order.place')) {
            return back();
        }

        $date = Carbon::create($y, $m, $d);

        if($date->lt(today())) {
            return back();
        }

        session()->put('order.date', $date);
        session()->forget('order.midwife_user_id');

        return to_route('order.cart');
    }

    public function render()
    {
        $period = Carbon::parse($this->selectedMonth)
            ->startOfMonth()
            ->startOfWeek()
            ->DaysUntil(Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek());

        $schedules = Order::query()
            ->where('place', Order::PLACE_CLINIC)
            ->whereMonth('start_datetime', Carbon::parse($this->selectedMonth)->month)
            ->locked()
            ->get();

        $data = collect();

        foreach ($period as $date) {
            $new = collect(['date' => $date]);
            foreach($schedules as $order) {
                if ( $order->start_datetime->format('m-d') == $date->format('m-d') ) {
                    foreach($this->slots as $slot){
                        if ( Carbon::parse($date->toDateString().$slot->time)->between($order->start_datetime, $order->end_datetime) ) {
                            $new->put($slot->time, 'booked');
                        } elseif ($new->has($slot->time)) {
                            //
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

        return view('order.clinic', [
            'data' => $data,
        ]);
    }
}
