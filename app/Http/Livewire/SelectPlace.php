<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectPlace extends Component
{
    public $place;

    public function mount() {
        $this->place = session('order.place') ?? '';
    }

    public function updatedPlace() {
        session()->put('order.place', $this->place);
    }

    public function render()
    {
        return view('livewire.select-place');
    }
}
