<?php

namespace App\Http\Livewire\Clients;

use App\Models\Family;
use App\Models\User;
use Livewire\Component;

class ClientFamilies extends Component
{
    public $client;
    public $state = [];

    public $successMessage = false;
    public $showDialog = false;

    protected $rules = [
        'state.name' => 'required|string|min:2|max:64',
        'state.birth_date' => 'required|date',
        'state.type' => 'required|string|in:Anak,Pasangan,Orang Tua,Saudara Kandung,Kerabat,Teman',
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.birth_date' => 'Tanggal lahir',
        'state.type' => 'Hubungan keluarga',
    ];

    public function mount(User $client)
    {
        $this->client = $client;
    }

    public function showEditDialog(Family $family)
    {
        $this->state = $family->toArray();
        $this->state['birth_date'] = $family->birth_date->toDateString();
        $this->showDialog = true;
    }

    public function showAddNewFamily()
    {
        $this->state = [];
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        Family::updateOrCreate(
            [
                'id' => $this->state['id'] ?? time(),
                'client_user_id' => auth()->id(),
            ],
            [
                'name' => $this->state['name'],
                'birth_date' => $this->state['birth_date'],
                'type' => $this->state['type'],
            ]

        );
        $this->showDialog = false;

        $this->successMessage = true;
    }

    public function render()
    {
        return view('clients.client-families');
    }
}
