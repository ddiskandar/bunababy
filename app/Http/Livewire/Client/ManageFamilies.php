<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class ManageFamilies extends Component
{
    public function render()
    {
        return view('client.manage-families')
            ->layout('layouts.client');
    }
}
