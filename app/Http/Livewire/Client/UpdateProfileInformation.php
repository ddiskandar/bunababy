<?php

namespace App\Http\Livewire\Client;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class UpdateProfileInformation extends Component
{
    use WithFileUploads;

    public $state = [];

    public $photo;

    public $successMessage = false;

    protected function rules()
    {
        return [
            'state.name' => 'required|string|min:2|max:64',
            'state.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id())
            ],
            'state.birth_date' => 'required|date',
            'state.phone' => 'required|string|min:11|max:13',
            'photo' => 'nullable|image|max:1024',
        ];
    }

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.birth_date' => 'Tanggal lahir',
        'state.phone' => 'Nomor WA',
        'photo' => 'Photo',
    ];

    public function mount()
    {
        $user = auth()->user();

        $this->state['name'] = $user->name;
        $this->state['email'] = $user->email;
        $this->state['phone'] = $user->profile->phone;
        $this->state['birth_date'] = $user->profile->birth_date ? $user->profile->birth_date->toDateString() : '';
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
        ]);

        $this->user->profile->update([
            'birth_date' => $this->state['birth_date'],
            'phone' => $this->state['phone'],
        ]);

        if(isset($this->photo))
        {
            $this->user->profile->update([
                'photo' => $this->photo->store('photos'),
            ]);
        }

        $this->successMessage = true;
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
