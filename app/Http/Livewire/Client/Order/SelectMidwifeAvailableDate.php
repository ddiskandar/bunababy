<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use App\Models\Slot;
use App\Models\Timetable;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class SelectMidwifeAvailableDate extends Component
{
    public $selectedMonth;
    public $slots;
    public $midwife;

    public function mount($midwife_user_id)
    {

        $this->selectedMonth = now()->format('Y-M');

        $this->slots = Slot::query()
            ->where('place_id', session('order.place_id'))
            ->orderBy('time')
            ->get();

        $this->midwife = User::find($midwife_user_id);
    }

    public function prevMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)
            ->subMonth()
            ->format('Y-M');
    }

    public function nextMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)
            ->addMonth()
            ->format('Y-M');
    }

    public function selectDate($d, $m, $y)
    {
        if (session()->missing('order.place_id')) {
            return back();
        }

        $date = Carbon::create($y, $m, $d);

        if ($date->lt(today())) {
            return back();
        }

        $timetable = Timetable::query()
            ->where('midwife_user_id', $this->midwife->id)
            ->whereDate('date', $date)
            ->where(function ($query) {
                $query->where('type', Timetable::LEAVE)
                    ->orWhere('type', Timetable::CLINIC);
            })
            ->first();

        if (isset($timetable) and $date->eq($timetable->date)) {
            return back();
        }

        session()->put('order.date', $date);
        session()->put('order.midwife_user_id', $this->midwife->id);

        return to_route('order.cart');
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
            ->where('midwife_user_id', $this->midwife->id)
            ->whereBetween('start_datetime', [Carbon::parse($this->selectedMonth)->startOfMonth()->startOfWeek(), Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek()])
            ->locked()
            ->select('id', 'place_id', 'midwife_user_id', 'status', 'start_datetime', 'end_datetime')
            ->get();

        $timetables = Timetable::query()
            ->where('midwife_user_id', $this->midwife->id)
            ->whereBetween('date', [Carbon::parse($this->selectedMonth)->startOfMonth()->startOfWeek(), Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek()])
            ->where(function ($query) {
                $query->where('type', Timetable::LEAVE)
                    ->orWhere('type', Timetable::CLINIC);
            })
            ->get();

        $data = collect();

        foreach ($period as $date) {
            $new = collect(['date' => $date]);

            foreach ($timetables as $timetable) {
                if ($timetable->date->format('m-d') == $date->format('m-d')) {
                    foreach ($this->slots as $slot) {
                        $new->put($slot->time, 'booked');
                    }
                }
            }

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

        return view('client.order.select-midwife-available-date', [
            'data' => $data,
        ]);
    }
}
