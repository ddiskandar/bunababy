<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class ManageAddresses extends Component
{
    public function render()
    {
        return view('client.manage-addresses')
            ->layout('layouts.client');
    }
}
