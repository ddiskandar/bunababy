<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class EditMidwife extends Component
{
    public $midwife;
    public $kecamatan_id = '';

    public $state = [];

    public $rules = [
        'kecamatan_id' => 'required|exists:kecamatans,id'
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
        ])->layout('layouts.app');
    }
}
