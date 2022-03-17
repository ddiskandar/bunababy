<?php

namespace App\Http\Livewire\Client;

use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ManageAddresses extends Component
{
    public $current_address;
    public $state = [];
    public $kecamatan;

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
        'state.kecamatan_id' => 'required|string',
    ];

    public function mount()
    {
        $this->current_address = new Address();
    }

    public function showEditDialog(Address $address)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dialogEditMode = true;
        $this->current_address = $address;
        $this->showDialog = true;
        $this->state = $address->toArray();
        $this->kecamatan = $address->kecamatan->name;
        // dd($this->state);
    }

    public function addNewAddress()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dialogEditMode = false;
        $this->current_address = [];
        $this->state = [];
        $this->kecamatan = '';
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        if($this->dialogEditMode)
        {
            $this->current_address->update([
                'label' => $this->state['label'],
                'address' => $this->state['address'],
                'rt' => $this->state['rt'],
                'rw' => $this->state['rw'],
                'desa' => $this->state['desa'],
                'note' => $this->state['note'],
            ]);
        } else {
            Address::create([
                'label' => $this->state['label'],
                'address' => $this->state['address'],
                'rt' => $this->state['rt'],
                'rw' => $this->state['rw'],
                'desa' => $this->state['desa'],
                'note' => $this->state['note'] ?? '',
                'kecamatan_id' => $this->state['kecamatan_id'],
                'client_user_id' => auth()->id(),
            ]);
        }

        $this->showDialog = false;

        $this->successMessage = true;
    }

    public function render()
    {
        return view('client.manage-addresses')
            ->layout('layouts.client');
    }
}
