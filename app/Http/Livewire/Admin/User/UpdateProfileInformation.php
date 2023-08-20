<?php

namespace App\Http\Livewire\Admin\User;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Setting;

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
            'state.phone' => 'nullable|string|min:11|max:14',
            'state.ig' => 'nullable',
            'photo' => 'nullable|image|max:256',
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

        try {

            $this->user->update([
                'name' => $this->state['name'],
                'email' => $this->state['email'],
            ]);

            $this->user->profile->update([
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

                return redirect()->route('user.profile');
            }

            $this->emit('saved');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function deleteProfilePhoto()
    {
        try {

            if(!$this->user->profile->photo) {
                return back();
            }

            Storage::disk('s3')->delete($this->user->profile->photo);

            $this->user->profile->update([
                'photo' => null,
            ]);

            return redirect()->route('user.profile');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.user.update-profile-information');
    }
}
