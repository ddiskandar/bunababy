<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class ChangePassword extends Component
{
    public function render()
    {
        return view('client.change-password')
            ->layout('layouts.client');
    }
}
