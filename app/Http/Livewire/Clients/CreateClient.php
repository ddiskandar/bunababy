<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateClient extends Component
{
    public $state = [];

    public $rules = [
        'state.name' => 'required|string',
        'state.email' => 'required|string',
        'state.phone' => 'required|string',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount()
    {
        $this->state['active'] = true;
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function(){
            $user = User::create([
                'name' => $this->state['name'],
                'email' => $this->state['email'],
                'type' => User::CLIENT,
                'password' => bcrypt('12345678'),
            ]);

            $user->profile()->create([
                'phone' => $this->state['phone'],
            ]);

            $this->emit('saved');

            return redirect()->route('clients.show', $user->id);
        });
    }

    public function render()
    {
        return view('clients.create-client');
    }
}
