<?php

namespace App\Http\Livewire\Admin\Orders;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Setting;
use App\Models\Payment;
use App\Models\Order;

class Payments extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $order;
    public $adjustment_name;
    public $adjustment_amount;
    public $state = [];
    public $payment;

    public $showDialog = false;
    public $dialogEditMode = false;

    public $showSetAdjustmentDialog = false;
    public $successMessage = false;

    protected $listeners = [
        'saved' => '$refresh',
    ];

    protected $rules = [
        'state.status' => 'required|in:1,2,3',
        'state.value' => 'required|numeric',
        'state.attachment' => 'nullable|image|max:1024',
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
        $this->dialogEditMode = false;
        $this->state['status'] = Payment::STATUS_VERIFIED;
    }

    public function showEditPaymentDialog(Payment $payment)
    {
        $this->payment = $payment;

        $this->state['id'] = $payment->id;
        $this->state['order_id'] = $payment->order_id;
        $this->state['status'] = $payment->status;
        $this->state['value'] = $payment->value;
        $this->state['note'] = $payment->note;
        $this->state['attachment'] = null;

        $this->dialogEditMode = true;
        $this->showDialog = true;
    }

    public function setAdjustment()
    {
        $this->validate([
            'adjustment_name' => 'required|string|min:3|max:256',
            'adjustment_amount' => 'required|numeric',
        ]);

        try {
            $this->authorize('manage-payments');

            $this->order->update([
                'adjustment_name' => $this->adjustment_name,
                'adjustment_amount' => $this->adjustment_amount,
            ]);

            $this->showSetAdjustmentDialog = false;

            $this->emit('saved');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-payments');

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
                        'attachment' => $this->state['attachment']
                            ? $this->state['attachment']->storePublicly('attachments', 's3')
                            : $this->payment->attachment,
                    ]
                );

                $this->order->update([
                    'status' => Order::STATUS_LOCKED,
                ]);
            });

            $this->showDialog = false;

            $this->emit('saved');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.orders.payments');
    }
}
