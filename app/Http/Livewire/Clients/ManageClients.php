<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageClients extends Component
{
    use WithPagination;

    public $perPage = 3;

    public $filterSearch;
    public $filterStatus;
    public $filterTag;

    protected $queryString = [
        'page' => ['except' => 1],
        'perPage' => ['except' => 3],
        'filterSearch' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'filterTag' => ['except' => ''],
    ];

    public function render()
    {
        $clients = User::query()
            ->where('type', User::CLIENT)
            ->where(function($query){
                $query->where('name', 'LIKE', '%' . $this->filterSearch . '%')
                ->orWhereHas('addresses.kecamatan', function ($query) {
                    $query->where('name', 'like', '%' . $this->filterSearch . '%');
                })
                ->orWhereHas('profile', function ($query) {
                    $query->where('phone', 'like', '%' . $this->filterSearch . '%')
                    ->orWhere('ig', 'like', '%' . $this->filterSearch . '%')
                    ;
                });
            })
            ->when($this->filterTag, function($query){
                $query->whereHas('tags', function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->filterTag . '%');
                });
            })
            ->with('tags', 'profile:user_id,photo,phone,ig', 'latestReservation')
            ->latest()
            ->paginate($this->perPage);

        // foreach($clients as $client)
        // {
        //     if(substr($client->profile->phone, 0, 2) == '08'){
        //         $client->profile->update([
        //             'phone' => substr_replace($client->profile->phone, '62', 0, 1),
        //         ]);
        //     }
        // }

        return view('clients.manage-clients', [
            'clients' => $clients,
        ]);
    }
}
