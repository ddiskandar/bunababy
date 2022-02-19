<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListMidwife extends Component
{
    protected $listeners = ['kecamatanIdChanged'];

    public function kecamatanIdChanged()
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.list-midwife', [
            'kecamatan' => DB::table('kecamatans')->where('id', session('kecamatanId'))->value('name'),
        ]);
    }
}
