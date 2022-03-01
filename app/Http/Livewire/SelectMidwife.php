<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Slot;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class SelectMidwife extends Component
{
    public $selectedMonth;
    public $slots;
    public $midwife;
    public $schedules;

    public function mount($midwife_user_id) {
        $this->selectedMonth = now()->format('Y-M');
        $this->slots = Slot::all();
        $this->midwife = User::query()
            ->where('id', $midwife_user_id)
            ->select('id', 'name', 'email')
            // ->with('schedules:id,place,midwife_user_id,date,start_time,end_time,status')
            ->first();
        $this->schedules = Order::query()
            ->where('status', Order::STATUS_LOCKED)
            ->where('midwife_user_id', $midwife_user_id)->get();
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
        $date = Carbon::create($y, $m, $d);

        session()->put('order.date', $date);
        session()->put('order.midwife_user_id', $this->midwife->id);

        if(session()->missing('order.place')) {
            return back();
        }

        return to_route('client.order.2');
    }

    public function render()
    {
        $period = Carbon::parse($this->selectedMonth)
            ->startOfMonth()
            ->startOfWeek()
            ->DaysUntil(Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek());

        $data = collect();

        foreach ($period as $date) {
            $new = collect(['date' => $date]);
            foreach($this->schedules as $order) {
                if ( $order->date->format('m-d') === $date->format('m-d') ) {
                    foreach($this->slots as $slot){
                        if ( Carbon::parse($slot->time)->between(Carbon::parse($order->start_time), Carbon::parse($order->end_time)) ) {
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

        return view('livewire.select-midwife', [
            'data' => $data,
        ]);
    }
}
