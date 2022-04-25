<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Treatment;
use Livewire\Component;

class SelectTreatments extends Component
{
    public $order;
    public $treatmentId;

    protected $listeners = [
        'saved' => '$refresh',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function delete($id)
    {
        $this->order->treatments()->detach($id);
        $this->updateTotalPrice();
    }

    public function save()
    {
        $this->validate([
            'treatmentId' => 'required'
        ]);

        $this->order->treatments()->attach($this->treatmentId);
        $this->treatmentId = '';
        $this->updateTotalPrice();
    }

    public function updateTotalPrice()
    {
        $this->order->update([
            'total_price' => $this->order->treatments()->sum('price')
        ]);

        $this->emit('saved');
    }

    public function render()
    {
        $treatments = Treatment::query()
            ->with('category')
            ->orderBy('category_id')
            ->orderBy('name')
            ->get();

        return view('orders.select-treatments', [
            'treatments' => $treatments,
        ]);
    }
}
