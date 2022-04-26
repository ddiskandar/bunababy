<?php

namespace App\Http\Livewire\Orders;

use App\Models\Address;
use App\Models\Order;
use Livewire\Component;

class AddressDetail extends Component
{
    public $order;
    public $client;
    public $selectedAddressId;
    public $place;

    public $state = [];

    public $showDialog = false;
    public $dialogEditMode = false;

    protected $rules = [
        'state.label' => 'required|string|min:3|max:32',
        'state.address' => 'required|string|min:3|max:255',
        'state.rt' => 'required|numeric|min:1|max:255',
        'state.rw' => 'required|numeric|min:1|max:255',
        'state.desa' => 'required|string|min:2|max:32',
        'state.note' => 'nullable|string|min:2|max:255',
        'state.kecamatan_id' => 'required|exists:kecamatans,id',
    ];

    protected $validationAttributes = [
        'state.label' => 'Label alamat',
        'state.address' => 'Kampung/Jalan',
        'state.rt' => 'Rt',
        'state.rw' => 'Rw',
        'state.desa' => 'Desa',
        'state.kecamatan_id' => 'Kecamatan',
        'state.note' => 'Catatan',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->client = $order->client;
        $this->place = $order->place;
        $this->selectedAddressId = $order->address_id;
    }

    public function updatedSelectedAddressId()
    {
        $this->order->update([
            'address_id' => $this->selectedAddressId,
        ]);
        $this->emit('saved');
    }

    public function updatedPlace()
    {
        $this->order->update([
            'address_id' => NULL,
            'place' => $this->place,
        ]);

        $this->emit('saved');
    }

    public function showEditDialog(Address $address)
    {
        $this->state = $address->toArray();
        $this->showDialog = true;
        $this->dialogEditMode = true;
    }

    public function addNewAddress()
    {
        $this->state = [];
        $this->showDialog = true;
        $this->dialogEditMode = false;
    }

    public function save()
    {
        $this->validate();

        Address::updateOrCreate(
            [
                'id' => $this->state['id'] ?? time(),
                'client_user_id' => $this->client->id,
                'kecamatan_id' => $this->state['kecamatan_id'],
            ],
            [
                'label' => $this->state['label'],
                'address' => $this->state['address'],
                'rt' => $this->state['rt'],
                'rw' => $this->state['rw'],
                'desa' => $this->state['desa'],
                'note' => $this->state['note'] ?? '',
            ]
        );

        $this->emit('saved');
        $this->showDialog = false;

    }

    public function render()
    {

        $addresses = Address::query()
            ->where('client_user_id', $this->client->id)
            ->get();

        return view('orders.address-detail', [
            'addresses' => $addresses,
        ]);
    }
}
