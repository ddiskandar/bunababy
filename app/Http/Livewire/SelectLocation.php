<?php

namespace App\Http\Livewire;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SelectLocation extends Component
{
    public $search = '';
    public $kecamatan;

    public function mount() {
        $this->kecamatan = DB::table('kecamatans')->where('id', session('kecamatan_id') )->value('name') ?? 'Pilih salah satu';
    }

    public function setLocation($kecamatan_id) {
        $this->kecamatan = DB::table('kecamatans')->where('id', $kecamatan_id )->value('name');
        session()->put('kecamatan_id', $kecamatan_id);

        $this->emit('kecamatanChanged');
        return redirect()->route('client.order');
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

        return view('livewire.select-location', [
            'kabupatens' => $kabupatens
        ]);
    }
}
