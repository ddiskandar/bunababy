<?php

namespace App\Http\Livewire\Payments;

use App\Models\Order;
use App\Models\Payment;
use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePayments extends Component
{
    use WithPagination;

    public $perPage = 8;

    public $showDialog = false;
    public $successMessage = false;

    public $filterSearch;
    public $filterStatus;

    public $state = [];
    public $order;

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 8],
    ];

    protected $rules = [
        'state.value' => 'required',
        'state.attachment' => 'nullable',
        'state.note' => 'nullable',
    ];

    protected $validationAttributes = [
        'state.name' => 'nama',
        'state.desc' => 'deskripsi',
        'state.price' => 'harga',
        'state.duration' => 'durasi',
        'state.order' => 'urutan',
        'state.category_id' => 'kategori',
        'state.active' => 'status aktif',
    ];

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFilterSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function showEditPaymentDialog(Payment $payment)
    {
        $this->state = $payment->toArray();
        $this->order = $payment->order;
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        if (isset($this->state['value']) && !is_numeric(str_replace('.', '', $this->state['value']))) {
            return $this->setErrorBag(['state.value' => 'Besar pembayaran harus berupa nilai angka.']);
        }

        Payment::updateOrCreate(
            [
                'id' => $this->state['id'] ?? Payment::max('id') + 1,
                'order_id' => $this->order->id,
            ],
            [
                'value' => str_replace('.', '', $this->state['value']),
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

        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();

        $this->emit('saved');
    }

    public function render()
    {
        $payments = Payment::query()
            ->latest()
            ->where(function ($query) {
                $query->where('value', 'LIKE', '%' . $this->filterSearch . '%')
                    ->orWhereHas('order', function ($query) {
                        $query->where('no_reg', 'LIKE', '%' . $this->filterSearch . '%')
                            ->orWhereHas('client', function ($query) {
                                $query->where('name', 'LIKE', '%' . $this->filterSearch . '%');
                            });
                    });
            })
            ->where('status', 'LIKE', '%' . $this->filterStatus)
            ->with(
                'order',
                'order.client',
                'order.payments',
                'verificator:id,name'
            )
            ->paginate($this->perPage);

        return view('payments.manage-payments', [
            'payments' => $payments,
        ]);
    }
}
