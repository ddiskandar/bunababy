<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateUserPassword extends Component
{
    public $user;
    public $errorCurrentPasswordMessage;
    public $current_password;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|confirmed',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function save()
    {
        $this->validate();

        if (! isset($this->current_password) || ! Hash::check($this->current_password, $this->user->password)) {
            return $this->errorCurrentPasswordMessage = 'The provided password does not match your current password.';
        }

        $this->user->forceFill([
            'password' => Hash::make($this->password),
        ]);

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';

        $this->emit('saved');
    }

    public function render()
    {
        return view('user.update-user-password');
    }
}
