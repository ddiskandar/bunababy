<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Payment;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Payments extends Component
{
    public $order;
    public $additional;
    public $state = [];

    public $showDialog = false;
    public $showSetAdditionalDialog = false;
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
        'additional' => 'Additional'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->additional = $order->additional;
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

    public function setAdditional()
    {
        $this->validate([
            'additional' => 'required|numeric'
        ]);

        $this->order->update([
            'additional' => $this->additional,
        ]);

        $this->showSetAdditionalDialog = false;
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

        $this->showDialog = false;
        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();
        $this->emit('saved');
    }

    public function render()
    {
        return view('orders.payments');
    }
}
