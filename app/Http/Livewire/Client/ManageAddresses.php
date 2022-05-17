<?php

namespace App\Http\Livewire\Client;

use App\Models\Address;
use Livewire\Component;

class ManageAddresses extends Component
{
    public $state = [];

    public $addresses;
    public $successMessage = false;
    public $showDialog = false;
    public $dialogEditMode = false;

    protected $rules = [
        'state.label' => 'required|string|min:3|max:32',
        'state.address' => 'required|string|min:3|max:255',
        'state.rt' => 'required|numeric|min:1|max:255',
        'state.rw' => 'required|numeric|min:1|max:255',
        'state.desa' => 'required|string|min:2|max:32',
        'state.kecamatan_id' => 'required|exists:kecamatans,id',
        'state.note' => 'nullable|string|min:2|max:255',
    ];

    protected $validationAttributes = [
        'state.label' => 'Label alamat',
        'state.address' => 'Kampung/Jalan',
        'state.rt' => 'Rt',
        'state.rw' => 'Rw',
        'state.desa' => 'Desa/Kelurahan',
        'state.note' => 'Catatan',
        'state.kecamatan_id' => 'Kecamatan',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount()
    {
        $this->addresses = Address::query()
            ->where('client_user_id', auth()->id())
            ->with('kecamatan', 'kecamatan.kabupaten')
            ->get();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
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

    public function setAsMainAddress($id)
    {
        foreach($this->addresses as $address){
            $address->update(['is_main' => false]);

            if($address->id == $id){
                $address->update(['is_main' => true]);
            }
        }
    }

    public function save()
    {
        $this->validate();

        $address = Address::updateOrCreate(
            [
                'id' => $this->state['id'] ?? time(),
                'client_user_id' => auth()->id(),
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

        $addresses = Address::where('client_user_id', auth()->id())->get();
        if(! $addresses->contains('is_main', 1)){
            $address->update(['is_main' => true]);
        }

        $this->showDialog = false;

        return to_route('client.addresses');
    }

    public function render()
    {
        return view('client.profile.manage-addresses')
            ->layout('layouts.client');
    }
}
