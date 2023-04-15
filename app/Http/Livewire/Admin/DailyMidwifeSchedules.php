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
                ->whereDate('startDateTime', $this->selectedDay)
                ->where(function ($query) {
                    $query->where('status', Order::STATUS_LOCKED)
                    ->orWhere('status', Order::STATUS_FINISHED);
                })
                ->select(
                    'id',
                    'place_id',
                    'midwife_user_id',
                    'client_user_id',
                    'startDateTime',
                    'endDateTime',
                    'address_id',
                    'status'
                )
                ->with(
                    'place:id,name',
                    'client:id,name',
                    'address:id,kecamatan_id',
                    'treatments:id,name',
                    'address.kecamatan:id,name'
                )
                ->orderBy('startDateTime', 'ASC')
                ->get();

        // dd($schedules);

        return view('admin.daily-midwife-schedules', [
            'schedules' => $schedules
        ]);
    }
}
