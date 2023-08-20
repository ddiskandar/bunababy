<?php

namespace App\Http\Livewire\Admin\Clients;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Livewire\Component;
use App\Models\Family;
use App\Models\Setting;
use App\Models\User;

class ClientFamilies extends Component
{
    use AuthorizesRequests;

    public $client;
    public $state = [];

    public $successMessage = false;
    public $showDialog = false;

    protected $rules = [
        'state.name' => 'required|string|min:2|max:64',
        'state.dob' => 'required|date',
        'state.type' => 'required|string|in:Anak,Pasangan,Orang Tua,Saudara Kandung,Kerabat,Teman',
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.dob' => 'Tanggal lahir',
        'state.type' => 'Hubungan keluarga',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $client)
    {
        $this->client = $client;
    }

    public function showEditDialog(Family $family)
    {
        $this->resetErrorBag();
        $this->state = $family->toArray();
        $this->state['dob'] = $family->dob->toDateString();
        $this->showDialog = true;
    }

    public function showAddNewFamily()
    {
        $this->resetErrorBag();
        $this->state = [];
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-clients');

            Family::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? time(),
                    'client_user_id' => $this->client->id,
                ],
                [
                    'name' => $this->state['name'],
                    'dob' => $this->state['dob'],
                    'type' => $this->state['type'],
                ]

            );

            $this->showDialog = false;

            $this->emit('saved');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.clients.client-families');
    }
}
