<?php

namespace App\Http\Livewire;

use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListMidwife extends Component
{
    protected $listeners  = [];
    public $kecamatan = '';

    public function mount() {
        $this->kecamatan = Kecamatan::query()
            ->where('id', session('kecamatan_id'))
            ->select('id', 'name')
            ->with(['midwives:id'])
            ->first();
    }

    public function render()
    {
        return view('livewire.list-midwife');
    }
}
