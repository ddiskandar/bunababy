<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class EditClientProfile extends Component
{
    public $user;
    public $name;
    public $email;
    public $phone;

    public $successMessage = false;

    protected $rules = [
        'name' => 'required|string|min:2|max:64',
        'email' => 'required|email',
        'phone' => 'required|string',
    ];

    public function mount()
    {
        $user = auth()->user();

        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function save()
    {
        $this->validate();
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->successMessage = true;
    }

    public function render()
    {
        return view('client.profile.edit')
            ->layout('layouts.client');
    }
}
