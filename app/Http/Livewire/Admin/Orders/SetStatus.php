<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\Setting;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SetStatus extends Component
{
    use AuthorizesRequests;

    public $order;

    public $finishedAt;

    protected $rules = [
        'finishedAt' => 'required'
    ];

    protected $validationAttributes = [
        'finishedAt' => 'Waktu selesai'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('set-order-status');

            $this->order->update([
                'finished_at' => Carbon::createFromFormat('H:i', $this->finishedAt),
                'status' => Order::STATUS_FINISHED,
            ]);

            $this->emit('saved');
        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.orders.set-status');
    }
}
