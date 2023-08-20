<?php

namespace App\Http\Livewire\Admin\Orders;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\OrderDeletedNotification;
use Filament\Notifications\Notification;
use Livewire\Component;
use App\Models\Setting;
use App\Models\Order;
use App\Models\User;

class Delete extends Component
{
    use AuthorizesRequests;

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

        try {
            $this->authorize('manage-orders');

            $owner = User::where('type', User::OWNER)->first();

            $owner->notify(new OrderDeletedNotification(auth()->user(), $this->order, $this->note));

            $this->order->delete();

            Notification::make()->title(Setting::DELETED_MESSAGE)->danger()->send();

            return to_route('orders');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }

    }

    public function render()
    {
        return view('admin.orders.delete');
    }
}
