<?php

namespace App\Http\Livewire\Orders;

use Livewire\Component;

class EditOrder extends Component
{
    public $order;

    public function render()
    {
        return view('orders.edit-order');
    }
}
