<?php

namespace App\Http\Livewire;

use App\Models\Slot;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SelectTime extends Component
{
    public function render()
    {
        $slots = DB::table('slots')->get();

        return view('livewire.select-time', [
            'slots' => $slots,
        ]);
    }
}
