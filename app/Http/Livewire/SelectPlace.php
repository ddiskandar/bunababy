<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectPlace extends Component
{
    public $place;

    public function mount() {
        $this->place = session('place_id') ?? '';
    }

    public function updatedPlace() {
        session()->put('place_id', $this->place);
    }

    public function render()
    {
        return view('livewire.select-place');
    }
}
