<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Slot;
use Carbon\Carbon;
use Livewire\Component;

class SelectMidwife extends Component
{
    public $selectedMonth;
    public $slots;
    public $orders;

    public function mount() {
        $this->selectedMonth = now()->format('Y-M');
        $this->slots = Slot::all();
        $this->orders = Order::all();
    }

    public function prevMonth() {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)->subMonth()->format('Y-M');
    }

    public function nextMonth() {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)->addMonth()->format('Y-M');
    }

    public function render()
    {
        $period = Carbon::parse($this->selectedMonth)->startOfMonth()->startOfWeek()->DaysUntil(Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek());
        $data = collect();

        foreach ($period as $date) {
            $new = collect(['date' => $date]);
            foreach($this->orders as $order) {
                if ( $order->date->format('m-d') === $date->format('m-d') ) {
                    foreach($this->slots as $slot){
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

        return view('livewire.select-midwife', [
            'data' => $data,
        ]);
    }
}
