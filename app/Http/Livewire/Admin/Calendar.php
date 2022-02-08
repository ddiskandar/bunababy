<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slot;
use App\Models\User;
use Livewire\Component;

class Calendar extends Component
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

        return view('livewire.admin.calendar', [
            'slots' => Slot::all()
        ]);
    }
}
