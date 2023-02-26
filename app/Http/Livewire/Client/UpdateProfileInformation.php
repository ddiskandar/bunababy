<?php

namespace App\Http\Livewire\Client;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class UpdateProfileInformation extends Component
{
    use WithFileUploads;

    public $state = [];

    public $photo;

    protected function rules()
    {
        return [
            'state.name' => 'required|string|min:2|max:64',
            'state.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id())
            ],
            'state.dob' => 'required|date',
            'state.phone' => 'required|string|min:11|max:14',
            'state.ig' => 'nullable',
            'photo' => 'nullable|image|max:128',
        ];
    }

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.dob' => 'Tanggal lahir',
        'state.phone' => 'Nomor WA',
        'state.ig' => 'Username IG',
        'photo' => 'Photo',
    ];

    public function mount()
    {
        $user = auth()->user();

        $this->state['name'] = $user->name;
        $this->state['email'] = $user->email;
        $this->state['phone'] = $user->profile->phone;
        $this->state['ig'] = $this->user->profile->ig;
        $this->state['dob'] = $user->profile->dob ? $user->profile->dob->toDateString() : '';
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->state['name'],
        ]);

        if (is_null(auth()->user()->google_id)) {
            $this->user->update([
                'email' => $this->state['email'],
            ]);
        }

        $this->user->profile->update([
            'dob' => $this->state['dob'],
            'phone' => $this->state['phone'],
            'ig' => $this->state['ig'],
        ]);

        if (isset($this->photo)) {
            $this->user->profile->update([
                'photo' => $this->photo->store('photos'),
            ]);
        }

        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->duration(3000)
            ->send();

        return to_route('client.profile');
    }

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function render()
    {
        return view('client.profile.update-profile-information')
            ->layout('layouts.client');
    }
}
