<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Address;
use App\Models\Order;
use Filament\Notifications\Notification;
use Livewire\Component;

class Screening extends Component
{
    public $order;

    public $state = [];

    protected $rules = [
        'state.screening' => 'nullable|string|min:3|max:256',
    ];

    protected $validationAttributes = [
        'state.screening' => 'Screening',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->state['screening'] = $order->screening;
    }

    public function save()
    {
        $this->validate();
        $this->order->update([
            'screening' => $this->state['screening'],
        ]);

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();

        $this->emit('saved');
    }

    public function render()
    {
        return view('admin.orders.screening');
    }
}
