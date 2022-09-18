<?php

namespace App\Http\Livewire;

use App\Models\Kabupaten;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SelectLocation extends Component
{
    public $search = '';
    public $kecamatan;

    public function mount() {

        $kecamatan_id = '';

        if( auth()->check() AND auth()->user()->isClient() AND session()->missing('order.kecamatan_id')) {
            $kecamatan_id = auth()->user()->addresses->where('is_main', true)->first()->kecamatan_id;
            session()->put('order.kecamatan_id', $kecamatan_id);
        }

        $this->kecamatan = 'Pilih lokasi';

        if(session()->has('order.kecamatan_id') OR $kecamatan_id){
            $this->kecamatan = DB::table('kecamatans')
                ->where('id', session('order.kecamatan_id') ?? $kecamatan_id )
                ->value('name');
        }

    }

    public function setLocation($kecamatan_id) {
        $kecamatan = DB::table('kecamatans')->where('id', $kecamatan_id )->first();
        $this->kecamatan = $kecamatan->name;

        session()->put('order.kecamatan_id', $kecamatan_id);
        session()->put('order.kecamatan_distance', $kecamatan->distance);

        // return redirect()->route('order.create');
    }

    public function render()
    {
        $kabupatens = Kabupaten::query()
                ->where(function ($query) {
                    $query->whereHas('Kecamatans', function ($query) {
                        $query->where('name', 'LIKE', $this->search . '%');
                    });
                })
                ->with('kecamatans', function ($query) {
                    $query->where('name', 'LIKE', $this->search . '%');
                })
                ->get();

        return view('select-location', [
            'kabupatens' => $kabupatens
        ]);
    }
}
