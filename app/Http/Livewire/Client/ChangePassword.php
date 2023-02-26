<?php

namespace App\Http\Livewire\Client;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $user;

    public $current_password;
    public $password;
    public $password_confirmation;
    public $errorCurrentPasswordMessage;

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

        if (!isset($this->current_password) || !Hash::check($this->current_password, $this->user->password)) {
            return $this->errorCurrentPasswordMessage = 'Password sekarang yang anda berikan tidak sesuai.';
        }

        $this->user->update([
            'password' => bcrypt($this->password),
        ]);

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';

        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();

        return to_route('client.profile');
    }

    public function render()
    {
        return view('client.profile.change-password')
            ->layout('layouts.client');
    }
}
