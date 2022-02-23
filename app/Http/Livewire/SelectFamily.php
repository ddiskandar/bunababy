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

        session()->push('order.family', [
            'id' => time(),
            'name' => $this->name,
            'type' => ! session('order.family') ? 'Diri Sendiri' : $this->type,
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
        $families = collect(session('order.family') ?? [] );

        return view('livewire.select-family', [
            'families' => $families,
        ]);
    }
}
