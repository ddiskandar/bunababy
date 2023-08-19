<?php

namespace App\Http\Livewire\Admin\Wilayah;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Setting;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ManageKecamatan extends Component
{
    use AuthorizesRequests;

    use WithPagination;

    public $perPage = 8;

    public $showDialog = false;

    public $filterSearch;
    public $filterKabupaten;
    public $filterStatus;

    public $state = [];

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 8],
        'filterKabupaten' => ['except' => ''],
        'filterStatus' => ['except' => ''],
    ];

    protected $rules = [
        'state.kabupaten_id' => 'required',
        'state.name' => 'required',
        'state.distance' => 'required',
        'state.active' => 'required',
    ];

    protected $validationAttributes = [
        'state.kabupaten_id' => 'Kabupaten',
        'state.name' => 'Nama',
        'state.distance' => 'Jarak',
        'state.active' => 'Status',
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
        $this->errorBag = [];
        $this->showDialog = true;
        $this->state = [];
        $this->state['active'] = true;
    }

    public function ShowEditKecamatanDialog(Kecamatan $kecamatan)
    {
        $this->state = $kecamatan->toArray();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-wilayah');

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

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        $kecamatan = Kecamatan::query()
            ->where(function ($query) {
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

        $kabupatens = Kabupaten::query()
            ->active()
            ->get();

        return view('admin.wilayah.manage-kecamatan', [
            'kecamatan' => $kecamatan,
            'kabupatens' => $kabupatens,
        ]);
    }
}
