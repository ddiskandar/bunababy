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
        'state.name' => 'required',
        'state.birth_date' => 'required|date',
        'state.type' => 'required',
    ];

    public function mount()
    {

    }

    public function showEditDialog(Family $family)
    {
        $this->state = $family->toArray();
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
                'birth_date' => $this->state['birth_date'],
                'type' => $this->state['type'],
            ]

        );
        $this->showDialog = false;

        $this->successMessage = true;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('client.manage-families')
            ->layout('layouts.client');
    }
}
