<?php

namespace App\Http\Livewire\Admin\Midwives;

use App\Models\Setting;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateMidwife extends Component
{
    use AuthorizesRequests;

    public $state = [];

    public $rules = [
        'state.name' => 'required|string|min:4|max:64',
        'state.email' => 'required|email|unique:users,email',
        'state.phone' => 'required|string|min:11|max:14',
    ];

    public $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.phone' => 'Nomor WA',
    ];

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-midwives');

            DB::transaction(function () {
                $user = User::create([
                    'name' => $this->state['name'],
                    'email' => $this->state['email'],
                    'type' => User::MIDWIFE,
                    'password' => bcrypt('12345678'),
                ]);

                $user->profile()->create([
                    'phone' => $this->state['phone'],
                ]);

                Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();
                return redirect()->route('midwives.edit', $user->id);
            });

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.midwives.create-midwife');
    }
}
