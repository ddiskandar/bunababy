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

        if(substr($this->order->client->profile->phone, 0, 2) == '08'){
            $this->order->client->profile->update([
                'phone' => substr_replace($this->order->client->profile->phone, '62', 0, 1),
            ]);
        }
    }

    public function render()
    {
        return view('orders.order-detail');
    }
}
