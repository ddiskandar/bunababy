<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class ChangePassword extends Component
{
    public $user;

    public $current_password;
    public $password;
    public $password_confirmation;

    public $successMessage = false;

    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|string|confirmed|min:4',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function save()
    {
        $this->validate();
        $this->user->update([
            'password' => bcrypt($this->password),
        ]);

        $this->successMessage = true;

        // return redirect()->route('profile');

    }

    public function render()
    {
        return view('client.change-password')
            ->layout('layouts.client');
    }
}
