<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;

class AuthBiodata extends Component
{
    public $address;

    public function mount()
    {
        $this->address = auth()->user()->addresses->where('kecamatan_id', session('order.kecamatan_id'))->first();
    }

    public function render()
    {
        return view('livewire.order.auth-biodata');
    }
}

