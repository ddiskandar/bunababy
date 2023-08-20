<?php

namespace App\Http\Livewire\Client;

use App\Models\Family;
use App\Models\Setting;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ManageFamilies extends Component
{
    use AuthorizesRequests;

    public $state = [];
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

    public function showEditDialog(Family $family)
    {
        $this->resetErrorBag();
        $this->state = $family->toArray();
        $this->state['dob'] = $family->dob->toDateString();
        $this->showDialog = true;
    }

    public function addNewFamily()
    {
        $this->resetErrorBag();
        $this->state = [];
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('create', Family::class);

            Family::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? time(),
                    'client_user_id' => auth()->id(),
                ],
                [
                    'name' => $this->state['name'],
                    'dob' => $this->state['dob'],
                    'type' => $this->state['type'],
                ]

            );
            $this->showDialog = false;

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('client.profile.manage-families')
            ->layout('layouts.client');
    }
}
