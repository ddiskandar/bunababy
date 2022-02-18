<?php

namespace App\Http\Livewire;

use App\Models\Slot;
use Livewire\Component;

class SelectTime extends Component
{
    public function render()
    {
        $slots = Slot::all();

        return view('livewire.select-time', [
            'slots' => $slots,
        ]);
    }
}
