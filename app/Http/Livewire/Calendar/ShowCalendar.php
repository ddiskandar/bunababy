<?php

namespace App\Http\Livewire\Calendar;

use App\Models\Slot;
use App\Models\User;
use Livewire\Component;

class ShowCalendar extends Component
{
    public $date;

    public function mount(){
        $this->date = today()->format('Y-m-d');
    }

    public function render()
    {
        $midwives = User::query()
            ->where('type', User::MIDWIFE)
            ->with('schedules', function($query){
                $query->where('date', $this->date);
            })
            ->get();

        return view('calendar.show-calendar', [
            'midwives' => $midwives,
        ]);
    }
}
