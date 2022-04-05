<?php

namespace App\Http\Livewire\Wilayah;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Livewire\Component;

class ManageKabupaten extends Component
{
    public $showDialog = false;
    public $successMessage = false;

    public $filterStatus;

    public $state = [];

    protected $queryString = [];

    protected $rules = [
        'state.name' => 'required',
        'state.distance' => 'nullable',
        'state.active' => 'required',
    ];

    protected $messages = [];

    protected $validationAttributes = [];

    public function showCreateNewKabupatenDialog()
    {
        $this->showDialog = true;
        $this->state = [];
        $this->state['active'] = true;
    }

    public function ShowEditKabupatenDialog( Kabupaten $kabupaten)
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
        $this->showSuccessMessage = true;
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
