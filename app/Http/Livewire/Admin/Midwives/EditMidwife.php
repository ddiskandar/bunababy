<?php

namespace App\Http\Livewire\Admin\Midwives;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Setting;
use App\Models\User;

class EditMidwife extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $photo;
    public $midwife;

    public $state = [];

    protected function rules()
    {
        return [
            'photo' => 'nullable|image|max:256',
            'state.name' => 'required|string|min:2|max:64',
            'state.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->midwife->id)
            ],
            'state.phone' => 'required|string|min:11|max:14',
            'state.active' => 'required',
        ];
    }

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.phone' => 'Nomor WA',
        'state.active' => 'Status',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->midwife = $user;
        $this->state = $user->toArray();
        $this->state['phone'] = $user->profile->phone;
    }

    public function resetPassword()
    {
        try {
            $this->authorize('manage-midwives');

            $newPassword = '12345678';

            $this->midwife->update([
                'password' => bcrypt($newPassword),
            ]);

            Notification::make()->title('Password : ' . $newPassword)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-midwives');

            DB::transaction(function () {
                $this->midwife->update([
                    'name' => $this->state['name'],
                    'email' => $this->state['email'],
                    'active' => $this->state['active'],
                ]);

                $this->midwife->profile->update([
                    'phone' => $this->state['phone'],
                ]);

                if ($this->photo) {
                    $this->midwife->profile->update([
                        'photo' => $this->photo->storePublicly('photos', 's3')
                    ]);
                }

                $this->emit('saved');
            });

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.midwives.edit-midwife');
    }
}
