<?php

namespace App\Http\Livewire\Midwives;

use App\Models\User;
use Livewire\Component;

class CreateMidwife extends Component
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
        $this->midwife = new User();
        $this->state['active'] = true;
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'type' => User::MIDWIFE,
            'password' => bcrypt('password'),
        ]);

        $user->profile->create([
            'phone' => $this->state['phone'],
        ]);

        $this->midwife = $user;

        $this->emit('saved');

        return redirect()->route('admin.midwives.edit', $user->id);
    }

    public function render()
    {
        return view();
    }
}
