<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use App\Models\Room;
use App\Models\Slot;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
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

    public function selectDate($date)
    {
        if (session()->missing('order.place_id')) {
            return back();
        }

        $date = Carbon::create($date);

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

    private function getSchedules()
    {
        return Order::query()
            ->where('place_id', session('order.place_id'))
            ->where('room_id', $this->room['id'])
            ->whereBetween('date', [
                Carbon::parse($this->selectedMonth)->startOfMonth()->startOfWeek(),
                Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek()
            ])
            ->locked()
            ->select('id', 'place_id', 'room_id', 'status', 'date', 'start_time', 'end_time')
            ->get();
    }

    private function getStatus($slotBooked)
    {
        if ($slotBooked->doesntContain('empty') && $slotBooked->doesntContain('booked')) {
            return 'kosong';
        }
        return $slotBooked->contains('empty') ? 'tersedia' : 'penuh';
    }

    public function render()
    {
        $data = collect();

        if ($this->readyToLoad) {
            $period = CarbonImmutable::parse($this->selectedMonth)
                ->startOfMonth()->startOfWeek()
                ->DaysUntil(
                    CarbonImmutable::parse($this->selectedMonth)
                        ->endOfMonth()->endOfWeek()
                );

            $schedules = $this->getSchedules();

            foreach ($period as $date) {
                $newDate = collect([
                    'path' => $date->format('Y/m/d'),
                    'date' => $date,
                    'day' => $date->day,
                    'withinMonth' => $date->isSameMonth(Carbon::parse($this->selectedMonth)),
                    'available' => $date->gte(today()),
                ]);

                $slotBooked = collect([]);

                foreach ($schedules as $order) {
                    if ($order->startDateTime->isSameDay($date)) {
                        foreach ($this->slots as $slot) {
                            if (Carbon::parse($date->toDateString() . $slot->time)
                                ->between($order->startDateTime, $order->endDateTime)) {
                                $slotBooked->put($slot->time, 'booked');
                            } else {
                                $slotBooked->put($slot->time, 'empty');
                            }
                        }
                    }
                }

                $status = $this->getStatus($slotBooked);

                $newDate->put('status', $status);

                $data->push($newDate);
            }
        }

        return view('client.order.select-clinic-room-available-date', [
            'data' => $data,
        ]);
    }
}
