<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use App\Models\Timetable;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Livewire\Component;

class SelectMidwifeAvailableDate extends Component
{
    public $readyToLoad = false;
    public $selectedMonth;
    public $midwife;
    public $slots;

    public function mount($midwifeUserId, $slots)
    {
        $this->selectedMonth = now()->format('Y-m');
        $this->slots = $slots;
        $this->midwife = User::find($midwifeUserId);
    }

    public function prevMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)
            ->subMonth()
            ->format('Y-m');
    }

    public function nextMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)
            ->addMonth()
            ->format('Y-m');
    }

    public function selectDate($date)
    {
        if (session()->missing('order.place_id')) {
            return back();
        }

        $date = Carbon::parse($date);

        if ($date->lt(today())) {
            return back();
        }

        $timetable = Timetable::query()
            ->where('midwife_user_id', $this->midwife->id)
            ->whereDate('date', $date)
            ->where(function ($query) {
                $query->where('type', Timetable::TYPE_LEAVE)
                    ->orWhere('type', Timetable::TYPE_CLINIC);
            })
            ->first();

        if (isset($timetable) && $date->eq($timetable->date)) {
            return back();
        }

        session()->put('order.date', $date);
        session()->put('order.midwife_user_id', $this->midwife->id);

        return to_route('order.cart');
    }

    public function load()
    {
        $this->readyToLoad = true;
    }

    private function getSchedules()
    {
        return Order::query()
            ->where('midwife_user_id', $this->midwife->id)
            ->whereBetween('date', [
                Carbon::parse($this->selectedMonth)->startOfMonth()->startOfWeek(),
                Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek()
            ])
            ->locked()
            ->select('id', 'place_id', 'midwife_user_id', 'status', 'date', 'start_time', 'end_time')
            ->get();
    }

    private function getTimetables()
    {
        return Timetable::query()
            ->where('midwife_user_id', $this->midwife->id)
            ->whereBetween('date', [
                Carbon::parse($this->selectedMonth)->startOfMonth()->startOfWeek(),
                Carbon::parse($this->selectedMonth)->endOfMonth()->endOfWeek()
            ])
            ->where(function ($query) {
                $query->where('type', Timetable::TYPE_LEAVE)
                    ->orWhere('type', Timetable::TYPE_CLINIC);
            })
            ->get();
    }

    private function getStatus($slotBooked)
    {
        if ($slotBooked->doesntContain('empty') && $slotBooked->doesntContain('booked')) {
            return 'kosong';
        }
        return $slotBooked->contains('empty') ? 'tersedia' : 'penuh';
    }

    private function getData()
    {
        $data = collect();

        $dates = CarbonImmutable::parse($this->selectedMonth)
            ->startOfMonth()->startOfWeek()
            ->DaysUntil(
                CarbonImmutable::parse($this->selectedMonth)
                    ->endOfMonth()->endOfWeek()
            );

        $schedules = $this->getSchedules();

        $timetables = $this->getTimetables();

        foreach ($dates as $date) {
            $newDate = collect([
                'path' => $date->format('Y/m/d'),
                'date' => $date,
                'day' => $date->day,
                'withinMonth' => $date->isSameMonth(Carbon::parse($this->selectedMonth)),
                'available' => $date->gte(today()),
            ]);

            $slotBooked = collect([]);

            foreach ($timetables as $timetable) {
                if ($timetable->date->isSameDay($date)) {
                    foreach ($this->slots as $slot) {
                        $slotBooked->put($slot->time, 'booked');
                    }
                }
            }

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

        return $data;
    }

    public function render()
    {
        $data = collect();

        if ($this->readyToLoad) {
            $data = $this->getData();
        }

        return view('client.order.select-midwife-available-date', [
            'data' => $data,
        ]);
    }
}
