<?php

namespace App\Http\Livewire\Order;

use App\Models\Payment;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NewPayment;
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
        'attachment' => 'required|image|max:1024',
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

        if(! $isPaymentsExists)
        {
            $this->value = $order->getDpAmount();
        }

        if($isPaymentsExists)
        {
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


    public function upload()
    {
        $this->validate();

        $attachment = $this->attachment->store('attachment');

        $payment = Payment::create([
            'order_id' => $this->order->id,
            'value' => $this->value,
            'attachment' => $attachment,
        ]);


        $this->showUploadDialog = false;
        $this->isLocked = true;

        $admin = User::where('type', User::ADMIN)
                ->orWhere('type', User::OWNER)
                ->get();

        Notification::send($admin, new NewPayment($payment));

        $this->render();

    }

    public function render()
    {
        $payments = Payment::where('order_id', $this->order->id)->get();

        return view('order.payments', [
            'payments' => $payments,
        ]);
    }
}
