<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use App\Models\Address;
use App\Models\User;

class ClientAddresses extends Component
{
    public $state = [];

    public $client;
    public $selectedAddressId;
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

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->client = $user;
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

        return view('clients.client-addresses', [
            'addresses' => $addresses,
        ]);
    }
}
