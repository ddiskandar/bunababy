<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class DailyMidwifeSchedules extends Component
{
    public $selectedDay;

    public function mount()
    {
        $this->selectedDay = today();
    }

    public function prevDay()
    {
        $this->selectedDay = $this->selectedDay->subDay();
    }

    public function nextDay()
    {
        $this->selectedDay = $this->selectedDay->addDay();
    }

    public function render()
    {
        $schedules = Order::query()
                ->where('midwife_user_id', auth()->id())
                ->whereDate('start_datetime', $this->selectedDay)
                ->where(function ($query) {
                    $query->where('status', Order::STATUS_LOCKED)
                    ->orWhere('status', Order::STATUS_FINISHED);
                })
                ->select(
                    'id',
                    'place',
                    'midwife_user_id',
                    'client_user_id',
                    'start_datetime',
                    'end_datetime',
                    'address_id',
                    'status'
                )
                ->with(
                    'client:id,name',
                    'address:id,kecamatan_id',
                    'treatments:id,name',
                    'address.kecamatan:id,name'
                )
                ->orderBy('start_datetime', 'ASC')
                ->get();

        // dd($schedules);

        return view('admin.daily-midwife-schedules', [
            'schedules' => $schedules
        ]);
    }
}
