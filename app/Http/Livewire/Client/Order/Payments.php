<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Payment;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NewPaymentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Payments extends Component
{
    use WithFileUploads;

    public $showUploadDialog = false;

    public $order;
    public $attachment;
    public $value;
    public $isLocked;

    protected $rules = [
        'attachment' => 'required|image|max:750',
        'value' => 'required',
    ];

    protected $validationAttributes = [
        'attachment' => 'lampiran foto',
        'value' => 'besar pembayaran'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;

        $isPaymentsExists = $this->order->payments()->exists();

        if (!$isPaymentsExists) {
            $this->value = $order->getDpAmount();
        }

        if ($isPaymentsExists) {
            $this->value = $order->getRemainingPayment();
        }

        $this->isLocked = $order->pendingPayments()->exists();
    }

    public function updatedAttachment()
    {
        $validator = Validator::make(
            ['attachment' => $this->attachment],
            ['attachment' => $this->rules['attachment']],
        );

        if ($validator->fails()) {
            $this->reset('attachment');
            $this->setErrorBag($validator->getMessageBag());
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function save()
    {
        $this->validate();

        if (isset($this->value) && !is_numeric(str_replace('.', '', $this->value))) {
            return $this->setErrorBag(['value' => 'Nominal pembayaran harus berupa nilai angka.']);
        }

        $payment = Payment::create([
            'order_id' => $this->order->id,
            'value' => str_replace('.', '', $this->value),
            'attachment' => $this->attachment->storePublicly('attachments', 's3'),
        ]);

        $this->showUploadDialog = false;
        $this->isLocked = true;

        $admin = User::where('type', User::ADMIN)
            ->orWhere('type', User::OWNER)
            ->get();

        Notification::send($admin, new NewPaymentNotification($payment));

        $this->render();
    }

    public function render()
    {
        $payments = Payment::where('order_id', $this->order->id)->get();

        return view('client.order.payments', [
            'payments' => $payments,
            'phone' => DB::table('options')->select('phone')->first()->phone
        ]);
    }
}
