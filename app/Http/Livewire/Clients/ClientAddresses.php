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

    public $showDialog = false;
    public $successMessage = false;

    protected $rules = [
        'state.label' => 'required|string|min:3|max:32',
        'state.address' => 'required|string|min:3|max:255',
        'state.rt' => 'required|numeric|min:1|max:255',
        'state.rw' => 'required|numeric|min:1|max:255',
        'state.desa' => 'required|string|min:2|max:32',
        'state.kecamatan_id' => 'required|exists:kecamatans,id',
        'state.note' => 'nullable|string|min:2|max:255',
        'state.share_location' => 'nullable|string|max:255',
    ];


    protected $validationAttributes = [
        'state.label' => 'Label',
        'state.address' => 'Kampung/Jalan',
        'state.rt' => 'Rt',
        'state.rw' => 'Rw',
        'state.desa' => 'Desa',
        'state.kecamatan_id' => 'Kecamatan',
        'state.note' => 'Catatan',
        'state.share_location' => 'Share Location',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->client = $user;
    }

    public function showAddNewAddressDialog()
    {
        $this->showDialog = true;
        $this->state = [];
    }

    public function showEditAddressDialog(Address $address)
    {
        $this->state = $address->toArray();
        $this->showDialog = true;
    }

    public function setAddressAsMain(Address $address)
    {
        $this->client->addresses()->update([
            'is_main' => false
        ]);

        $address->update([
            'is_main' => true
        ]);
    }

    public function save()
    {
        $this->validate();

        Address::updateOrCreate(
            [
                'id' => $this->state['id'] ?? Address::max('id') + 1,
            ],
            [
                'client_user_id' => $this->client->id,
                'label' => $this->state['label'],
                'address' => $this->state['address'],
                'rt' => $this->state['rt'],
                'rw' => $this->state['rw'],
                'desa' => $this->state['desa'],
                'kecamatan_id' => $this->state['kecamatan_id'],
                'note' => $this->state['note'] ?? NULL,
                'share_location' => $this->state['share_location'] ?? NULL,
            ]
        );

        $this->emit('saved');

        $this->showDialog = false;
        $this->successMessage = true;

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
