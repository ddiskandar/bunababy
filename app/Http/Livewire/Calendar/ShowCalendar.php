<?php

namespace App\Http\Livewire\Calendar;

use App\Models\Slot;
use App\Models\User;
use Livewire\Component;

class ShowCalendar extends Component
{
    public $midwives;
    public $date;

    public function mount(){
        $this->date = today()->format('Y-m-d');
        $this->midwives = User::where('type', User::MIDWIFE)
                        ->orWhereHas('schedules', function($query){
                            $query->where('date', $this->date);
                        })
                        ->with('schedules')
                        ->get();

        // dd($this->selectedDate);
    }

    public function render()
    {

        return view('calendar.show-calendar', [
            'slots' => Slot::all()
        ]);
    }
}
