<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectFamily extends Component
{
    public $name;
    public $type = 'Anak';

    public $showAddFamily = false;

    protected $rules = [
        'name' => 'min:2|max:32'
    ];

    public function mount()
    {

    }

    public function addFamily()
    {
        $this->validate();

        session()->push('order.families', [
            'id' => time(),
            'name' => $this->name,
            'birthdate' => '',
            'type' => ! session('order.families') ? 'Diri Sendiri' : $this->type,
        ]);
        $this->name = '';
        $this->showAddFamily = false;
    }

    public function selectFamily($familyId)
    {
        $this->emit('familySelected', $familyId);
    }

    public function render()
    {
        $families = collect(session('order.families') ?? [] );

        return view('livewire.select-family', [
            'families' => $families,
        ]);
    }
}
