<?php

namespace App\Http\Livewire\Client;

use App\Models\Family;
use Livewire\Component;

class ManageFamilies extends Component
{
    public $state = [];

    public $successMessage = false;
    public $showDialog = false;

    protected $rules = [
        'state.name' => 'required|string|min:2|max:64',
        'state.dob' => 'required|date',
        'state.type' => 'required|string|in:Anak,Pasangan,Orang Tua,Saudara Kandung,Kerabat,Teman',
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.dob' => 'Tanggal lahir',
        'state.type' => 'Hubungan keluarga',
    ];

    public function mount()
    {
    }

    public function showEditDialog(Family $family)
    {
        $this->state = $family->toArray();
        $this->state['dob'] = $family->dob->toDateString();
        $this->showDialog = true;
    }

    public function addNewFamily()
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
                'dob' => $this->state['dob'],
                'type' => $this->state['type'],
            ]

        );
        $this->showDialog = false;

        $this->successMessage = true;
    }

    public function render()
    {
        return view('client.profile.manage-families')
            ->layout('layouts.client');
    }
}
