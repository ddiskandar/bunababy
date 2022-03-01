<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AuthBiodata extends Component
{
    public $address;
    public $fullAddress;

    public function mount()
    {
        $this->address = auth()->user()->addresses()->where('kecamatan_id', session('order.kecamatan_id'))->first();
        $this->fullAddress = $this->address->address . " Rt. " . $this->address->rt . " Rw. " . $this->address->rw . " Desa/Kel. " . $this->address->desa . " Kec. " . $this->address->kecamatan->name . " " . $this->address->kecamatan->kabupaten->name;
    }

    public function render()
    {
        return view('livewire.auth-biodata');
    }
}

