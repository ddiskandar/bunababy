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

    public $attachment;
    public $isLocked;
    public $order;
    public $value;
    public $messages;

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

        $phone = DB::table('options')->select('phone')->first()->phone;

        $this->messages['waiting'] = 'https://api.whatsapp.com/send?phone='.toWaIndo($phone).'&text=Halo+Bunababy_Care.+Perkenalkan+saya+dengan+'.auth()->user()->name.'.%0AMohon+segera+konfirmasi+pembayaran+%2A'.$this->order->id.'%2A.';
        $this->messages['upload'] = 'https://api.whatsapp.com/send?phone='.toWaIndo($phone).'&text=Halo+Bunababy_Care.+Perkenalkan+saya+dengan+'.auth()->user()->name.'.%0AMau+mengirim+bukti+transfer+dengan+ID+transaksi+%2A'.$order->id.'%2A.';

        $this->value = $order->getDpAmount();

        $hasPayments = $this->order->payments()->exists();

        if ($hasPayments) {
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
        ]);
    }
}
