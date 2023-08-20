<?php

namespace App\Http\Livewire\Admin\Payments;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Setting;

class ManagePayments extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;

    public $perPage = 8;
    public $showDialog = false;

    public $filterSearch;
    public $filterStatus;

    public $state = [];
    public $attachment;
    public $order;

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 8],
    ];

    protected $rules = [
        'state.value' => 'required',
        'state.status' => 'required',
        'state.attachment' => 'nullable',
        'state.note' => 'nullable',
    ];

    protected $validationAttributes = [
        'state.value' => 'Nominal',
        'state.status' => 'Status',
        'state.attachment' => 'Bukti',
        'state.note' => 'Catatan',
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
        $this->resetErrorBag();
        $this->state = $payment->toArray();
        $this->order = $payment->order;
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-payments');

            if ($this->state['status'] === Payment::STATUS_UNVERIFIED) {
                return $this->setErrorBag(['state.status' => 'Status pembayaran harus dipilih.']);
            }

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
                    'verified_by_id' => auth()->id(),
                    'verified_at' => now(),
                    'note' => $this->state['note'] ?? '',
                    'attachment' => $this->attachment
                            ? $this->attachment->storePublicly('attachments', 's3')
                            : $this->state['attachment'],
                ]
            );

            $this->order->update([
                'status' => Order::STATUS_LOCKED,
            ]);

            $this->showDialog = false;

            $this->emit('saved');

            $this->reset('attachment', 'state', 'order');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        $payments = Payment::query()
            ->latest()
            ->where(function ($query) {
                $query->where('value', 'LIKE', '%' . $this->filterSearch . '%')
                    ->orWhereHas('order', function ($query) {
                        $query->where('id', 'LIKE', '%' . $this->filterSearch . '%')
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

        return view('admin.payments.manage-payments', [
            'payments' => $payments,
        ]);
    }
}
