<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageClients extends Component
{
    use WithPagination;

    public $perPage = 6;

    public $filterSearch;
    public $filterStatus;

    public $state = [];

    protected $queryString = [];

    protected $rules = [];

    protected $messages = [];

    protected $validationAttributes = [];

    public function save()
    {
        //
    }

    public function render()
    {
        $clients = User::query()
            ->where('type', User::CLIENT)
            ->where(function($query){
                $query->where('name', 'LIKE', '%' . $this->filterSearch . '%')
                // ->orWhereHas('kecamatans', function ($query) {
                //     $query->where('name', 'like', '%' . $this->filterSearch . '%');
                // })
                ;
            })

            // ->with()
            ->paginate($this->perPage);

        return view('clients.manage-clients', [
            'clients' => $clients,
        ]);
    }
}
