<?php

namespace App\Http\Livewire;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Livewire\Component;

class SelectLocation extends Component
{
    public $search = '';
    public $kecamatan;

    public function mount() {
        $this->kecamatan = Kecamatan::where('id', session('kecamatanId') )->first()->name;
    }

    public function setLocation($kecamatanId) {
        $this->kecamatan = Kecamatan::where('id', $kecamatanId )->first()->name;
        session()->put('kecamatanId', $kecamatanId);
        $this->emit('kecamatanIdChanged');
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
