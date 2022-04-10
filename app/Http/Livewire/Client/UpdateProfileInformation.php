<?php

namespace App\Http\Livewire\Client;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileInformation extends Component
{
    use WithFileUploads;

    public $state = [];

    public $photo;

    public $successMessage = false;

    protected $rules = [
        'state.name' => 'required|string|min:2|max:64',
        'state.email' => 'required|email',
        'state.phone' => 'required|string',
        'photo' => 'nullable|image',
    ];

    public function mount()
    {
        $user = auth()->user();

        $this->state['name'] = $user->name;
        $this->state['email'] = $user->email;
        $this->state['phone'] = $user->phone;
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
        ]);

        $this->user->profile->update([
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
