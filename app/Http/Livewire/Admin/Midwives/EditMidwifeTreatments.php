<?php

namespace App\Http\Livewire\Admin\Midwives;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditMidwifeTreatments extends Component
{
    public $midwife;
    public $treatmentId = '';

    protected $rules = [
        'treatmentId' => 'required'
    ];

    protected $validationAttributes = [
        'treatmentId' => 'Treatment'
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->midwife = $user;
    }

    public function add()
    {
        $this->validate();
        $this->midwife->treatments()->attach([$this->treatmentId]);
        $this->treatmentId = '';
        $this->emit('saved');
    }

    public function delete($id)
    {
        $this->midwife->treatments()->detach([$id]);
        $this->emit('saved');
    }

    public function render()
    {
        $treatments = $this->midwife->treatments;

        $treatmentsFiltered = DB::table('treatments')
            ->whereNotIn('id', $this->midwife->treatments->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.midwives.edit-midwife-treatments', [
            'treatments' => $treatments,
            'treatmentsFiltered' => $treatmentsFiltered
        ]);
    }
}
