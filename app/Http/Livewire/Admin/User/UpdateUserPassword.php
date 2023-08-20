<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Setting;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateUserPassword extends Component
{
    public $errorCurrentPasswordMessage;
    public $password_confirmation;
    public $current_password;
    public $user;
    public $password;

    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|string|confirmed|min:4',
    ];

    public $validationAttributes = [
        'current_password' => 'Password',
        'password' => 'Password',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function save()
    {
        $this->validate();

        try {
            if (! isset($this->current_password) || ! Hash::check($this->current_password, $this->user->password)) {
                return $this->errorCurrentPasswordMessage = 'Password sekarang yang anda berikan tidak sesuai.';
            }

            $this->user->update([
                'password' => Hash::make($this->password),
            ]);

            $this->current_password = '';
            $this->password = '';
            $this->password_confirmation = '';

            $this->emit('saved');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.user.update-user-password');
    }
}
