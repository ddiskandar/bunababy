<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ClientProfileInformation extends Component
{
    use WithFileUploads;

    public $client;
    public $photo;

    public $state = [];

    protected function rules()
    {
        return [
            'state.name' => 'required|string|min:2|max:64',
            'state.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->client->id)
            ],
            'state.phone' => 'nullable|string|min:11|max:13',
            'state.ig' => 'nullable',
            'photo' => 'nullable|image|max:128',
        ];
    }

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.phone' => 'Nomor WA',
        'state.ig' => 'Username IG',
        'photo' => 'Photo',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->client = $user;
        $this->client->load('profile');
        $this->state = $this->client->toArray();
        $this->state['phone'] = $this->client->profile->phone;
        $this->state['ig'] = $this->client->profile->ig;
    }

    public function save()
    {
        $this->validate();

        $this->client->update([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
        ]);

        $this->client->profile->update([
            'phone' => $this->state['phone'],
            'ig' => $this->state['ig'],
        ]);

        if (isset($this->photo)) {
            $this->client->profile->update([
                'photo' => $this->photo->store('photos'),
            ]);
        }

        $this->emit('saved');
    }

    public function render()
    {
        return view('clients.client-profile-information');
    }
}
