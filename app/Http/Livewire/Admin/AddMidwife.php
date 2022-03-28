<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddMidwife extends Component
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

    protected $listeners = ['refreshPage' => '$refresh'];

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
            'phone' => $this->state['phone'],
            'type' => User::MIDWIFE,
            'password' => bcrypt('password'),
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

        return view('midwives.add-midwife', [
            'kecamatans' => $kecamatans,
            'kecamatansFiltered' => $kecamatansFiltered
        ]);
    }
}
