<?php

namespace App\Http\Livewire\Order;

use App\Models\Payment;
use App\Models\Order;
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
    ];

    protected $messages = [
        'attachment.required' => 'lampiran foto harus diisi',
        'attachment.image' => 'lampiran foto harus berupa image foto',
        'attachment.max' => 'ukuran file lampiran foto maksimal 1MB',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->value = $order->dp_amount();
        $this->isLocked = $order->pendingPayments()->exists();
    }

    public function updatedAttachment($value)
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

        Payment::create([
            'order_id' => $this->order->id,
            'value' => $this->value,
            'attachment' => $attachment,
        ]);


        $this->showUploadDialog = false;
        $this->isLocked = true;
        $this->render();

    }

    public function render()
    {
        $payments = Payment::where('order_id', $this->order->id)->get();

        return view('client.order.payments', [
            'payments' => $payments,
        ]);
    }
}
