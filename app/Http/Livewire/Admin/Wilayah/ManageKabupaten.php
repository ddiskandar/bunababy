<?php

namespace App\Http\Livewire\Admin\Wilayah;

use Filament\Notifications\Notification;
use Livewire\Component;
use App\Models\Kabupaten;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ManageKabupaten extends Component
{
    use AuthorizesRequests;

    public $showDialog = false;

    public $filterStatus;

    public $state = [];

    protected $queryString = [];

    protected $rules = [
        'state.name' => 'required|string|min:2|max:64',
        'state.active' => 'required',
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.active' => 'Status',
    ];

    public function showCreateNewKabupatenDialog()
    {
        $this->resetErrorBag();
        $this->showDialog = true;
        $this->state = [];
        $this->state['active'] = true;
    }

    public function ShowEditKabupatenDialog(Kabupaten $kabupaten)
    {
        $this->resetErrorBag();
        $this->state = $kabupaten->toArray();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-wilayah');

            Kabupaten::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? Kabupaten::max('id') + 1,
                ],
                [
                    'name' => $this->state['name'],
                    'active' => $this->state['active'],
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
        $kabupaten = Kabupaten::query()
            ->Where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->withCount('kecamatans')
            ->get();

        return view('admin.wilayah.manage-kabupaten', [
            'kabupaten' => $kabupaten
        ]);
    }
}
