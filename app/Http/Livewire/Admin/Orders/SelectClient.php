<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\User;
use Livewire\Component;

class SelectClient extends Component
{
    public $showModalPicker = false;
    public $search = '';
    public $selectedClient;

    public function setSelectedClient($id)
    {
        $this->selectedClient = User::find($id);
        $this->showModalPicker = false;
        $this->emit('clientSelected', ['id' => $id]);
    }

    public $readyToLoad = false;

    public function load()
    {
        $this->readyToLoad = true;
        $this->showModalPicker = true;
    }

    public function render()
    {
        $clients = [];
        // if ($this->readyToLoad && strlen($this->search) > 2) {
        if ($this->readyToLoad) {
            $clients = User::query()
                ->clients()->active()
                ->select('id', 'name')
                ->with('profile')
                ->where('name', 'like', "%{$this->search}%")
                ->orderBy('name')
                ->get();
        }

        return view('admin.orders.select-client', [
            'clients' => $clients,
        ]);
    }
}
