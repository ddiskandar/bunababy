<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateClient extends Component
{
    use WithFileUploads;

    public $photo;
    public $state = [];

    public $rules = [
        'state.name' => 'required|string',
        'state.email' => 'required|string',
        'state.phone' => 'required|string',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount()
    {
        $this->client = new User();
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'type' => User::CLIENT,
            'password' => bcrypt('12345678'),
        ]);

        $user->profile()->create([
            'phone' => $this->state['phone'],
        ]);

        if($this->photo)
        {
            $user->update([
                'photo' => $this->photo->store('photos')
            ]);
        }
        $this->client = $user;

        $this->emit('saved');

        return redirect()->route('clients.show', $user->id);
    }

    public function render()
    {
        return view('clients.create-client');
    }
}
