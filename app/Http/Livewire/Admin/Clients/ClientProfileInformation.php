<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\User;

class ClientProfileInformation extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $client;
    public $photo;

    public $state = [];

    protected function rules()
    {
        return [
            'state.name' => 'required|string|min:2|max:64',
            'state.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->client->id)
            ],
            'state.dob' => 'nullable|date',
            'state.phone' => 'required|string|min:11|max:14',
            'state.ig' => 'nullable',
            'photo' => 'nullable|image|max:256',
        ];
    }

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.dob' => 'Tanggal Lahir',
        'state.phone' => 'Nomor WA',
        'state.ig' => 'Username IG',
        'photo' => 'Photo',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->client = $user;
        $this->client->load('profile');
        $this->state = $this->client->toArray();
        $this->state['dob'] = $this->client->profile->dob ? $this->client->profile->dob->toDateString() : null;
        $this->state['phone'] = $this->client->profile->phone;
        $this->state['ig'] = $this->client->profile->ig;
    }

    public function resetPassword()
    {
        try {
            $this->authorize('manage-clients');

            $this->client->update([
                'password' => bcrypt('12345678'),
            ]);

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-clients');

            $this->client->update([
                'name' => $this->state['name'],
                'email' => $this->state['email'],
            ]);

            $this->client->profile->update([
                'dob' => $this->state['dob'] ?? null,
                'phone' => $this->state['phone'],
                'ig' => $this->state['ig'],
            ]);

            if (isset($this->photo)) {
                $this->client->profile->update([
                    'photo' => $this->photo->storePublicly('photos', 's3'),
                ]);
            }

            $this->emit('saved');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.clients.client-profile-information');
    }
}
