<?php

namespace App\Http\Livewire\Wilayah;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Filament\Notifications\Notification;
use Livewire\Component;

class ManageKabupaten extends Component
{
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
        $this->showDialog = true;
        $this->state = [];
        $this->state['active'] = true;
    }

    public function ShowEditKabupatenDialog(Kabupaten $kabupaten)
    {
        $this->state = $kabupaten->toArray();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

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
        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();
    }

    public function render()
    {
        $kabupaten = Kabupaten::query()
            ->Where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->withCount('kecamatans')
            ->get();

        return view('wilayah.manage-kabupaten', [
            'kabupaten' => $kabupaten
        ]);
    }
}
