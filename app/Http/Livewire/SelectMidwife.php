<?php

namespace App\Http\Livewire;

use App\Models\Slot;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class SelectMidwife extends Component
{
    public $selectedMonth;
    public $slots;
    public $midwife;

    public function mount($midwife_user_id) {
        $this->selectedMonth = now()->format('Y-M');
        $this->slots = Slot::all();
        $this->midwife = User::query()
            ->where('id', $midwife_user_id)
            ->select('id', 'name', 'email')
            ->with('schedules')
            ->first();
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

        session()->put('selected_date', $date);
        session()->put('midwife_user_id', $this->midwife->id);

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
            foreach($this->midwife->schedules as $order) {
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
