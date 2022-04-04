<?php

namespace App\Http\Livewire\Clients;

use App\Models\Order;
use Livewire\Component;

class CreateClient extends Component
{
    public function render()
    {
        return view('clients.create-client');
    }
}
