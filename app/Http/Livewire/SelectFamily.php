<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectFamily extends Component
{
    public $name;
    public $type = 'Anak';

    public $showAddFamily = false;

    public function mount()
    {

    }

    public function addFamily()
    {
        session()->push('order.family', [
            'name' => $this->name,
            'type' => $this->type,
        ]);
        $this->name = '';
        $this->showAddFamily = false;
    }

    public function render()
    {
        $families = collect(session('order.family') ?? []);

        return view('livewire.select-family', [
            'families' => $families,
        ]);
    }
}
