<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditPlaceSlotsAndTreatments extends Component
{
    public $midwife;
    public $kecamatanId = '';

    protected $rules = [
        'kecamatanId' => 'required'
    ];

    protected $validationAttributes = [
        'kecamatanId' => 'Wilayah'
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->midwife = $user;
    }

    public function add()
    {
        $this->validate();
        $this->midwife->kecamatans()->attach([$this->kecamatanId]);
        $this->kecamatanId = '';
        $this->emit('saved');
    }

    public function delete($id)
    {
        $this->midwife->kecamatans()->detach([$id]);
        $this->emit('saved');
    }

    public function render()
    {
        $kecamatans = $this->midwife->kecamatans;

        $kecamatansFiltered = DB::table('kecamatans')
            ->whereNotIn('id', $this->midwife->kecamatans->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.places.edit-place-slots-and-treatments', [
            'kecamatans' => $kecamatans,
            'kecamatansFiltered' => $kecamatansFiltered
        ]);
    }
}
