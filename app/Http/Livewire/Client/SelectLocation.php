<?php

namespace App\Http\Livewire\Client;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SelectLocation extends Component
{
    public $showModalPicker = false;
    public $search = '';
    public $kecamatan;

    public function mount()
    {
        if (auth()->check() && auth()->user()->isClient() && session()->missing('order.kecamatan_id') && session()->missing('order.kecamatan_distance')) {
            $id = DB::table('addresses')
                ->where('client_user_id', auth()->id())
                ->where('is_main', true)
                ->value('kecamatan_id');

            if ($id) {
                $this->putSessionKecamatan($id);
            }
        }

        if (session()->has('order.kecamatan_id')) {
            $this->kecamatan = Kecamatan::find(session()->get('order.kecamatan_id'));
        }
    }

    public function putSessionKecamatan($id)
    {
        $this->kecamatan = Kecamatan::find($id);
        session()->put('order.kecamatan_id', $this->kecamatan->id);
        session()->put('order.kecamatan_distance', $this->kecamatan->distance);
    }

    public function setLocation($id)
    {
        $this->putSessionKecamatan($id);
        $this->showModalPicker = false;
        $this->emit('locationChanged');
    }

    public $readyToLoad = false;

    public function load()
    {
        $this->readyToLoad = true;
    }

    public function showModal()
    {
        $this->showModalPicker = true;
    }

    public function render()
    {
        if ($this->readyToLoad) {
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
        } else {
            $kabupatens = collect();
        }

        return view('client.select-location', [
            'kabupatens' => $kabupatens
        ]);
    }
}
