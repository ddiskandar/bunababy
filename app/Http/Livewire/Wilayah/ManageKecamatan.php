<?php

namespace App\Http\Livewire\Wilayah;

use App\Models\Kecamatan;
use Livewire\Component;
use Livewire\WithPagination;

class ManageKecamatan extends Component
{
    use WithPagination;

    public $perPage = 8;

    public $showDialog = false;
    public $showSuccessMessage = false;

    public $filterSearch;
    public $filterKabupaten;
    public $filterStatus;

    public $state = [];

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 3],
        'filterKabupaten' => ['except' => ''],
        'filterStatus' => ['except' => ''],
    ];

    protected $rules = [
        'state.kabupaten_id' => 'required',
        'state.name' => 'required',
        'state.distance' => 'required',
        'state.active' => 'required',
    ];

    protected $messages = [
        //
    ];

    protected $validationAttributes = [
        'state.kabupaten_id' => 'kabupaten',
        'state.name' => 'nama',
        'state.distance' => 'jarak',
        'state.active' => 'status',
    ];

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFilterSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterKabupaten()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function showCreateNewKecamatanDialog()
    {
        $this->showDialog = true;
        $this->state = [];
        $this->state['active'] = true;
    }

    public function ShowEditKecamatanDialog( Kecamatan $kecamatan )
    {
        $this->state = $kecamatan->toArray();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        Kecamatan::updateOrCreate(
            [
                'id' => $this->state['id'] ?? Kecamatan::max('id') + 1,
            ],
            [
                'kabupaten_id' => $this->state['kabupaten_id'],
                'name' => $this->state['name'],
                'distance' => $this->state['distance'],
                'active' => $this->state['active'],
            ]
        );

        $this->showDialog = false;
        $this->showSuccessMessage = true;
    }

    public function render()
    {
        $kecamatan = Kecamatan::query()
            ->where(function($query){
                $query
                ->where('name', 'LIKE', '%' . $this->filterSearch . '%')
                ->orWhere('distance', 'LIKE', '%' . $this->filterSearch . '%');
            })
            ->Where('kabupaten_id', 'LIKE', '%' . $this->filterKabupaten . '%')
            ->Where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->with('kabupaten')
            ->withCount('midwives')
            ->orderBy('kabupaten_id')->orderBy('name')
            ->paginate($this->perPage);

        return view('wilayah.manage-kecamatan', [
            'kecamatan' => $kecamatan,
        ]);
    }
}
