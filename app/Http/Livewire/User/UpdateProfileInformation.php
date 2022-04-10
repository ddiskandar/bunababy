<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class UpdateProfileInformation extends Component
{
    use WithFileUploads;

    public $user;
    public $photo;

    public $state = [];

    protected $rules = [
        'state.name' => 'required',
        'state.email' => 'required|email',
        'state.profile.phone' => 'required',
        'state.profile.ig' => 'nullable',
        'photo' => 'nullable|image',
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->user->load('profile');
        $this->state = $this->user->toArray();
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
        ]);

        $this->user->profile->update([
            'phone' => $this->state['profile']['phone'],
            'ig' => $this->state['profile']['ig'],
        ]);

        if (isset($this->photo)) {
            $this->user->profile->update([
                'photo' => $this->photo->store('photos'),
            ]);

            return redirect()->route('user.profile');
        }

        $this->emit('saved');
    }

    public function render()
    {
        return view('user.update-profile-information');
    }
}
