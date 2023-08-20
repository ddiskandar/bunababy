<?php

namespace App\Http\Livewire\Client;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Setting;

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
            'photo' => 'nullable|image|max:256',
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

        try {
            abort_if($this->user->id !== auth()->id(), 403);

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
                if($this->user->profile->photo) {
                    Storage::disk('s3')->delete($this->user->profile->photo);
                }

                $this->user->profile->update([
                    'photo' => $this->photo->storePublicly('photos', 's3'),
                ]);
            }

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

            return to_route('client.profile');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
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
