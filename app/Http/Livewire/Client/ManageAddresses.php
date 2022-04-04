<?php

namespace App\Http\Livewire\Client;

use App\Models\Address;
use Livewire\Component;

class ManageAddresses extends Component
{
    public $state = [];

    public $successMessage = false;
    public $showDialog = false;
    public $dialogEditMode = false;

    protected $rules = [
        'state.label' => 'required|string',
        'state.address' => 'required|string',
        'state.rt' => 'required|string',
        'state.rw' => 'required|string',
        'state.desa' => 'required|string',
        'state.note' => 'nullable|string',
        'state.kecamatan_id' => 'required',
    ];

    public function mount()
    {
        //
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

    public function save()
    {
        $this->validate();

        Address::updateOrCreate(
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

        $this->showDialog = false;

        $this->successMessage = true;
    }

    public function render()
    {
        return view('client.profile.manage-addresses')
            ->layout('layouts.client');
    }
}
