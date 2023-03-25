<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\Payment;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Payments extends Component
{
    public $order;
    public $adjustment_name;
    public $adjustment_amount;
    public $state = [];

    public $showDialog = false;
    public $showSetAdjustmentDialog = false;
    public $successMessage = false;

    protected $listeners = [
        'saved' => '$refresh',
    ];

    protected $rules = [
        'state.status' => 'required|in:1,2,3',
        'state.value' => 'required|numeric',
        // 'state.attachment' => 'nullable|image|max:1024',
        'state.note' => 'nullable|max:64',
    ];

    protected $validationAttributes = [
        'state.status' => 'Status pembayaran',
        'state.value' => 'Besar pembayaran',
        'state.attachment' => 'lampiran foto',
        'state.note' => 'Catatan',
        'adjustment_name' => 'Nama penyesuaian',
        'adjustment_amount' => 'Nominal penyesuaian',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->adjustment_amount = $order->adjustment_amount;
        $this->adjustment_name = $order->adjustment_name;
    }

    public function showAddNewPaymentDialog()
    {
        $this->showDialog = true;
        $this->state = [];
        $this->state['status'] = Payment::STATUS_VERIFIED;
    }

    public function showEditPaymentDialog(Payment $payment)
    {
        $this->state = $payment->toArray();
        $this->showDialog = true;
    }

    public function setAdjustment()
    {
        $this->validate([
            'adjustment_name' => 'required|string|min:3|max:256',
            'adjustment_amount' => 'required|numeric',
        ]);

        $this->order->update([
            'adjustment_name' => $this->adjustment_name,
            'adjustment_amount' => $this->adjustment_amount,
        ]);

        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();

        $this->showSetAdjustmentDialog = false;
        $this->emit('saved');
    }

    public function save()
    {
        $this->validate();
        // dd('here');

        DB::transaction(function () {
            Payment::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? Payment::max('id') + 1,
                    'order_id' => $this->order->id,
                ],
                [
                    'value' => $this->state['value'],
                    'status' => $this->state['status'] ?? Payment::STATUS_VERIFIED,
                    'verified_at' => now(),
                    'note' => $this->state['note'] ?? '',
                    'verified_by_id' => auth()->id(),
                ]
            );

            $this->order->update([
                'status' => Order::STATUS_LOCKED,
            ]);
        });

        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();
        $this->showDialog = false;
        $this->emit('saved');
    }

    public function render()
    {
        return view('admin.orders.payments');
    }
}
