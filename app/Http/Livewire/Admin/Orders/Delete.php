<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderDeleted;
use Filament\Notifications\Notification;
use Livewire\Component;

class Delete extends Component
{
    public $showDialog = false;
    public $order;
    public $note;

    protected $rules = [
        'note' => 'required|string|min:4|max:255'
    ];

    protected $validationAttributes = [
        'note' => 'Alasan'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function confirmDelete()
    {
        $this->showDialog = true;
    }

    public function delete()
    {
        $this->validate();

        $owner = User::where('type', User::OWNER)->first();

        $owner->notify(new OrderDeleted(auth()->user(), $this->order, $this->note));

        $this->order->delete();

        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();

        return to_route('orders');
    }

    public function render()
    {
        return view('admin.orders.delete');
    }
}
