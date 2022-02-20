<?php

namespace App\Http\Livewire;

use App\Models\User;
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

        $midwives = User::where('role', 'midwife')->get();

        return view('livewire.list-midwife', [
            'midwives' => $midwives,
            'kecamatan' => DB::table('kecamatans')->where('id', session('kecamatanId'))->value('name'),
        ]);
    }
}
