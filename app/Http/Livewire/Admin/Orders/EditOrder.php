<?php

namespace App\Http\Livewire\Admin\Orders;

use Livewire\Component;

class EditOrder extends Component
{
    public $order;

    public function render()
    {
        return view('admin.orders.edit-order');
    }
}
