<?php

namespace App\Http\Livewire\Admin\Clients;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Setting;
use App\Models\User;

class CreateClient extends Component
{
    use AuthorizesRequests;

    public $state = [];

    public $rules = [
        'state.name' => 'required|string',
        'state.email' => 'required|email|unique:users,email',
        'state.phone' => 'required|string',
        'state.dob' => 'nullable|date',
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.phone' => 'Nomor WA',
        'state.dob' => 'Tanggal Lahir',
    ];

    public function mount()
    {
        $this->state['active'] = true;
    }

    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $user = User::create([
                    'name' => $this->state['name'],
                    'email' => $this->state['email'],
                    'type' => User::CLIENT,
                    'password' => bcrypt('12345678'),
                ]);

                $user->profile()->create([
                    'phone' => $this->state['phone'],
                    'dob' => $this->state['dob'] ?? null,
                ]);

                Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();
                return redirect()->route('clients.show', $user->id);
            });

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.clients.create-client');
    }
}
