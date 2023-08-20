<?php

namespace App\Http\Livewire\Admin\Orders;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Livewire\Component;
use App\Models\Setting;
use App\Models\Order;

class Screening extends Component
{
    use AuthorizesRequests;

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

        try {
            $this->authorize('manage-orders');

            $this->order->update([
                'screening' => $this->state['screening'],
            ]);

            $this->emit('saved');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.orders.screening');
    }
}
