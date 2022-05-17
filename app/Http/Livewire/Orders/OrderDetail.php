<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderDetail extends Component
{
    public $order;
    public $baby;

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->baby = auth()->user()->families->where('type', 'Anak')->first();
    }

    public function activate()
    {
        $this->order->update([
            'status' => Order::STATUS_LOCKED,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->emit('saved');
    }

    public function render()
    {
        return view('orders.order-detail');
    }
}
