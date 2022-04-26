<?php

namespace App\Http\Livewire\Midwives;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditMidwife extends Component
{
    use WithFileUploads;

    public $photo;
    public $midwife;

    public $state = [];

    protected function rules()
    {
        return [
            'photo' => 'nullable|image|max:128',
            'state.name' => 'required|string|min:2|max:64',
            'state.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->midwife->id)
            ],
            'state.phone' => 'required|string|min:11|max:13',
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

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $this->midwife->update([
                'name' => $this->state['name'],
                'email' => $this->state['email'],
                'active' => $this->state['active'],
            ]);

            $this->midwife->profile->update([
                'phone' => $this->state['phone'],
            ]);

            if($this->photo)
            {
                $this->midwife->profile->update([
                    'photo' => $this->photo->store('photos')
                ]);
            }

            $this->emit('saved');
        });
    }

    public function render()
    {
        return view('midwives.edit-midwife');
    }
}
