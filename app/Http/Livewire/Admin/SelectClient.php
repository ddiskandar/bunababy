<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SelectClient extends Component
{
    public $search = '';
    public $clients = [];
    public $selectedClient;

    protected $listeners = [
        'selectedClientChanged',
        'updatedPlace'
    ];

    public function selectedClientChanged()
    {
        // dd('here');
    }

    public function updatedPlace()
    {
        dd('updatedPlace');
    }

    public function mount()
    {

        if (auth()->check()) {
            //
        }

        $this->selectedClient = 'Pilih Client';
    }

    public function setSelectedClient($user_id)
    {
        $user = DB::table('users')->where('id', $user_id)->first();
        $this->selectedClient = $user->name;
        $this->emit('timeChanged');
    }

    public $readyToLoad = false;

    public function load()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $this->clients = User::query()
                ->where('type', User::CLIENT)
                ->where('name', 'LIKE', '%' . $this->search . '%')
                ->orderBy('name')
                ->with('profile')
                ->get();
        }

        return view('admin.select-client');
    }
}
