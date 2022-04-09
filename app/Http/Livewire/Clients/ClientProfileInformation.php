<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClientProfileInformation extends Component
{
    use WithFileUploads;

    public $client;
    public $photo;

    public $state = [];

    public $rules = [
        'state.name' => 'required|string',
        'state.email' => 'required|string',
        'state.profile.phone' => 'required|string',
        'state.profile.ig' => 'required|string',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->client = $user;
        $this->client->load('profile');
        $this->state = $this->client->toArray();
    }

    public function render()
    {
        return view('clients.client-profile-information');
    }
}
