<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateProfileInformation extends Component
{
    use WithFileUploads;

    public $user;
    public $photo;

    public $state = [];

    protected $listeners = ['saved' => '$refresh'];

    protected function rules()
    {
        return [
            'state.name' => 'required|string|min:2|max:64',
            'state.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id())
            ],
            'state.phone' => 'nullable|string|min:11|max:13',
            'state.ig' => 'nullable',
            'photo' => 'nullable|image|max:128',
        ];
    }

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.email' => 'Email',
        'state.phone' => 'Nomor WA',
        'state.ig' => 'Username IG',
        'photo' => 'Photo',
    ];

    public function mount()
    {
        $this->user = auth()->user();

        $this->user->load('profile');
        $this->state = $this->user->toArray();
        $this->state['phone'] = $this->user->profile->phone;
        $this->state['ig'] = $this->user->profile->ig;
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
            'ig' => $this->state['ig'],
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
        return view('admin.user.update-profile-information');
    }
}
