<?php

namespace App\Http\Livewire\Orders;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class AddressDetail extends Component
{
    public $state = [];

    public $order;
    public $client;
    public $selectedAddressId;
    public $place;

    public $showAddNewAddressForm = false;

    protected $rules = [
        'state.label' => 'required',
        'state.address' => 'required',
        'state.rt' => 'required',
        'state.rw' => 'required',
        'state.desa' => 'required',
        'state.kecamatan_id' => 'required',
        'state.note' => 'nullable',
    ];

    protected $listeners = [
        'saved' => '$refresh'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->client = $order->client;
        $this->place = $order->place;
        $this->selectedAddressId = $order->address_id;

        // dd($this->client);
    }

    public function updatedSelectedAddressId()
    {
        $this->order->update([
            'address_id' => $this->selectedAddressId,
        ]);
    }

    public function updatedPlace()
    {
        $this->order->update([
            'place' => $this->place,
        ]);
    }

    public function save()
    {
        $this->validate();

        Address::create([
            'client_user_id' => $this->client->id,
            'label' => $this->state['label'],
            'address' => $this->state['address'],
            'rt' => $this->state['rt'],
            'rw' => $this->state['rw'],
            'desa' => $this->state['desa'],
            'kecamatan_id' => $this->state['kecamatan_id'],
            'note' => $this->state['note'] ?? '',
        ]);

        $this->emit('saved');

        $this->showAddNewAddressForm = false;

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
