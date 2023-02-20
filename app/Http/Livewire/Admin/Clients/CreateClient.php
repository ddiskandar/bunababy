<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateClient extends Component
{
    public $state = [];

    public $rules = [
        'state.name' => 'required|string',
        'state.email' => 'required|email|unique:users,email',
        'state.phone' => 'required|string',
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.phone' => 'Nomor WA',
    ];

    public function mount()
    {
        $this->state['active'] = true;
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $user = User::create([
                'name' => $this->state['name'],
                'email' => $this->state['email'],
                'type' => User::CLIENT,
                'password' => bcrypt('12345678'),
            ]);

            $user->profile()->create([
                'phone' => $this->state['phone'],
            ]);

            return redirect()->route('clients.show', $user->id);
        });
    }

    public function render()
    {
        return view('admin.clients.create-client');
    }
}
