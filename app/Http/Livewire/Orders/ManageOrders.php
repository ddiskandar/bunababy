<?php

namespace App\Http\Livewire\Orders;

use App\Models\Kabupaten;
use App\Models\Order;
use Livewire\Component;

class ManageOrders extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.orders.manage-orders', [
            'orders' => Order::with('client:id,name', 'treatments')->latest('date')->get(),
        ]);
    }
}
