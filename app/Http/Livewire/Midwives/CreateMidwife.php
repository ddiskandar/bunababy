<?php

namespace App\Http\Livewire\Midwives;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateMidwife extends Component
{
    public $state = [];

    public $rules = [
        'state.name' => 'required|string|min:4|max:64',
        'state.email' => 'required|email|unique:users,email',
        'state.phone' => 'required|string|min:11|max:13',
    ];

    public $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.phone' => 'Nomor WA',
    ];

    public function save()
    {
        $this->validate();

        DB::transaction(function(){
            $user = User::create([
                'name' => $this->state['name'],
                'email' => $this->state['email'],
                'type' => User::MIDWIFE,
                'password' => bcrypt('12345678'),
            ]);

            $user->profile()->create([
                'phone' => $this->state['phone'],
            ]);

            $this->emit('saved');

            return redirect()->route('midwives.edit', $user->id);
        });

    }

    public function render()
    {
        return view('midwives.create-midwife');
    }
}
