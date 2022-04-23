<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;

class AuthUser extends Component
{
    public $address;
    public $baby;

    public function mount()
    {
        $this->address = auth()->user()->addresses->where('kecamatan_id', session('order.kecamatan_id'))->first();
        $this->baby = auth()->user()->families->where('type', 'Anak')->first();
    }

    public function render()
    {
        return view('order.auth-user');
    }
}

