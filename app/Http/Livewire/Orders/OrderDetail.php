<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderDetail extends Component
{
    public $order;

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('orders.order-detail');
    }
}
