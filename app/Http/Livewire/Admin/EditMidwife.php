<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditMidwife extends Component
{
    use WithFileUploads;

    public $photo;
    public $midwife;
    public $kecamatan_id = '';

    public $state = [];

    public $rules = [
        'state.name' => 'required|string',
        'state.email' => 'required|string',
        'state.phone' => 'required|string',
        'state.active' => 'required',
    ];

    public function mount(User $user)
    {
        $this->midwife = $user;
        $this->state = $user->toArray();
    }

    protected $listeners = ['refreshPage' => '$refresh'];

    public function addWilayah()
    {

        $this->validate();
        $this->midwife->kecamatans()->attach([$this->kecamatan_id]);
        $this->kecamatan_id = '';
        $this->emit('refreshPage');

    }

    public function deleteWilayah($id)
    {
        $this->midwife->kecamatans()->detach([$id]);
        $this->emit('refreshPage');
    }

    public function save()
    {
        $this->validate();

        $this->midwife->update([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'phone' => $this->state['phone'],
            'active' => $this->state['active'],
        ]);

        if($this->photo)
        {
            $this->midwife->update([
                'photo' => $this->photo->store('photos')
            ]);
        }

        $this->emit('saved');
    }

    public function render()
    {
        $kecamatans = $this->midwife->kecamatans;

        $kecamatansFiltered = \DB::table('kecamatans')
            ->whereNotIn('id', $this->midwife->kecamatans
            ->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('livewire.admin.edit-midwife', [
            'kecamatans' => $kecamatans,
            'kecamatansFiltered' => $kecamatansFiltered
        ]);
    }
}
