<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use App\Models\Room;
use App\Models\Slot;
use Carbon\Carbon;
use Livewire\Component;

class SelectClinicRoomAvailableDate extends Component
{
    public $readyToLoad = false;
    public $selectedMonth;
    public $slots;
    public $room;

    public function mount($id, $name, $slots)
    {
        $this->selectedMonth = now()->format('Y-M');
        $this->slots = $slots;
        $this->room['id'] = $id;
        $this->room['name'] = $name;
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

        session()->put('order.date', $date);
        session()->put('order.room_id', $this->room['id']);
        session()->forget('order.midwife_user_id');

        return to_route('order.cart');
    }

    public function load()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $data = collect();

        if ($this->readyToLoad) {
            $period = Carbon::parse($this->selectedMonth)
                ->startOfMonth()
                ->startOfWeek()
                ->DaysUntil(
                    Carbon::parse($this->selectedMonth)
                        ->endOfMonth()
                        ->endOfWeek()
                );

            $schedules = Order::query()
                ->where('place_id', session('order.place_id'))
                ->where('room_id', $this->room['id'])
                ->whereBetween('date', [Carbon::parse($this->selectedMonth)->startOfMonth()->startOfWeek(), Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek()])
                ->locked()
                ->select('id', 'place_id', 'room_id', 'status', 'date', 'start_time', 'end_time')
                ->get();


            foreach ($period as $date) {
                $new = collect(['date' => $date]);

                foreach ($schedules as $order) {

                    if ($order->startDateTime->format('m-d') === $date->format('m-d')) {
                        foreach ($this->slots as $slot) {
                            if (Carbon::parse($date->toDateString() . $slot->time)->between($order->startDateTime, $order->endDateTime)) {
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
        }

        return view('client.order.select-clinic-room-available-date', [
            'data' => $data,
        ]);
    }
}
