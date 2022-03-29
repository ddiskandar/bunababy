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
        $this->midwives = User::where('role', 'midwife')
                        ->with('schedules')->get();
        $this->date = today()->format('Y-m-d');

        // dd($this->selectedDate);
    }

    public function render()
    {

        return view('livewire.calendar.show-calendar', [
            'slots' => Slot::all()
        ]);
    }
}
