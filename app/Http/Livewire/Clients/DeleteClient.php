<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Livewire\Component;

class DeleteClient extends Component
{
    public $showDialog = false;
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function confirmDelete()
    {
        $this->showDialog = true;
    }

    public function delete()
    {
        $this->user->delete();
        return to_route('clients');
    }

    public function render()
    {
        return view('clients.delete-client');
    }
}
