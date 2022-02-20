<?php

namespace App\Http\Livewire;

use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListMidwife extends Component
{
    protected $listeners  = [];
    public $kecamatan;
    public $midwives;

    public function mount() {
        $this->kecamatan = Kecamatan::query()
            ->where('id', session('kecamatan_id'))
            ->select('id', 'name')
            ->with(['midwives:id'])
            ->first();

        $this->midwives = User::query()
            ->where('role', 'midwife')
            ->whereNotIn('id', $this->kecamatan->midwives->pluck('id'))
            ->get();

    }

    public function render()
    {
        return view('livewire.list-midwife');
    }
}
