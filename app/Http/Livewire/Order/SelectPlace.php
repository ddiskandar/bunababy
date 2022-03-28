<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;

class SelectPlace extends Component
{
    public $place;

    public function mount() {
        if (session()->missing('order.place')) {
            session()->put('order.place', 1);
        }
        $this->place = session('order.place') ;
    }

    public function updatedPlace() {
        session()->put('order.place', $this->place);
    }

    public function render()
    {
        return view('client.order.select-place');
    }
}
