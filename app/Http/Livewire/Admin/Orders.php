<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.admin.orders', [
            'orders' => Order::with('client:id,name', 'treatments')->latest('date')->get(),
        ]);
    }
}
