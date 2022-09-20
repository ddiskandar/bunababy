<?php

namespace App\Http\Livewire\Client;

use App\Models\Order;
use Livewire\Component;

class CardOrder extends Component
{
    public $reservation;

    public function mount(Order $reservation)
    {
        $this->$reservation = $reservation;
    }

    public function render()
    {
        return view('client.card-order');
    }
}
