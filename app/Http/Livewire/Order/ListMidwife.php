<?php

namespace App\Http\Livewire\Order;

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

        if (session()->has('order.kecamatan_id')) {

            $this->kecamatan = Kecamatan::query()
                ->where('id', session('order.kecamatan_id'))
                ->select('id', 'name')
                ->with([
                    'midwives' => function($query) {
                        $query->active();
                    }
                ])
                ->first();

            $this->midwives = User::query()
                ->midwives()->active()
                ->whereNotIn('id', $this->kecamatan->midwives->pluck('id'))
                ->select('id', 'name', 'type')
                ->get();
        }

    }

    public function render()
    {
        return view('order.list-midwife');
    }
}
