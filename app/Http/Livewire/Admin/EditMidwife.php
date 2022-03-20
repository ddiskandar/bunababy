<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class EditMidwife extends Component
{
    public $midwife;
    public $kecamatan_id;

    public $state = [];

    public function mount(User $user)
    {
        $this->midwife = $user;
        $this->state = $user->toArray();
    }

    public function addWilayah()
    {
        $this->midwife->kecamatans()->attach([$this->kecamatan_id]);
        $this->render();
    }

    public function deleteWilayah($id)
    {
        $this->midwife->kecamatans()->detach([$id]);
    }

    public function render()
    {
        $kecamatans = $this->midwife->kecamatans;

        return view('livewire.admin.edit-midwife', [
            'kecamatans' => $kecamatans
        ])
        ->layout('layouts.app');
    }
}
