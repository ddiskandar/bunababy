<?php

namespace App\Http\Livewire\Midwives;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateMidwife extends Component
{
    use WithFileUploads;

    public $photo;

    public $state = [];
    public $kecamatan_id;

    public $rules = [
        'state.name' => 'required|string',
        'state.email' => 'required|string',
        'state.phone' => 'required|string',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount()
    {
        $this->midwife = new User();
        $this->state['active'] = true;

    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'type' => User::MIDWIFE,
            'password' => bcrypt('password'),
        ]);

        $user->profile([
            'phone' => $this->state['phone'],
        ]);

        if($this->photo)
        {
            $user->update([
                'photo' => $this->photo->store('photos')
            ]);
        }
        $this->midwife = $user;

        $this->emit('saved');

        return redirect()->route('admin.midwives.edit', $user->id);
    }

    public function render()
    {
        $kecamatans = $this->midwife->kecamatans;

        $kecamatansFiltered = \DB::table('kecamatans')
            ->whereNotIn('id', $this->midwife->kecamatans
            ->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('midwives.create-midwife', [
            'kecamatans' => $kecamatans,
            'kecamatansFiltered' => $kecamatansFiltered
        ]);
    }
}
