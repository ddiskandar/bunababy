<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;

class Payments extends Component
{
    public $order;

    public $showDialog = false;
    public $showSetAdditionalDialog = false;
    public $successMessage = false;

    public $additional;

    public $state = [];

    protected $listeners = [
        'saved' => '$refresh',
    ];

    protected $rules = [
        'state.value' => 'required',
        'state.attachment' => 'nullable',
        'state.note' => 'nullable',
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
        $this->order->update([
            'additional' => $this->additional,
        ]);
        $this->showSetAdditionalDialog = false;
        $this->emit('saved');
    }

    public function save()
    {
        $this->validate();

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

        $this->showDialog = false;
        $this->successMessage = true;
        $this->emit('saved');
    }

    public function render()
    {
        return view('orders.payments');
    }
}
