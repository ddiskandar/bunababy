<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class ClientHistory extends Component
{
    public function render()
    {
        return view('client.history')
            ->layout('layouts.client');
    }
}
