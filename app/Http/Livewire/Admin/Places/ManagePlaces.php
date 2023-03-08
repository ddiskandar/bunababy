<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePlaces extends Component
{
    use WithPagination;

    public $perPage = 3;

    public $showDialog = false;

    public $filterSearch;
    public $filterStatus;

    public $state = [];


    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 3],
        'filterStatus' => ['except' => ''],
    ];

    protected $rules = [
        'state.name' => 'required|min:3',
        'state.desc' => 'required',
        'state.type' => 'required|numeric',
        'state.order' => 'required|numeric',
        'state.active' => 'required|boolean',
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.desc' => 'Deskripsi',
        'state.type' => 'Type',
        'state.order' => 'Urutan',
        'state.active' => 'Status',
    ];

    public function mount()
    {
        //
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFilterSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function showAddNewPlaceDialog()
    {
        $this->showDialog = true;
        $this->state = [];
        $this->state['active'] = true;
    }

    public function ShowEditPlaceDialog(Place $Place)
    {
        dd($Place->toArray());
        $this->state = $Place->toArray();
        foreach ($this->places as $place) {
            $this->state['prices'][$place->id] = $Place->prices->where('place_id', $place->id)->value('amount');
        }
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            Place::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? Place::max('id') + 1,
                ],
                [
                    'name' => $this->state['name'],
                    'desc' => $this->state['desc'],
                    'type' => $this->state['type'],
                    'order' => $this->state['order'],
                    'active' => $this->state['active'],
                ]
            );
        });

        $this->showDialog = false;
        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();
    }

    public function render()
    {
        $places = Place::query()
            ->where(function ($query) {
                $query
                    ->where('name', 'LIKE', '%' . $this->filterSearch . '%')
                    ->orWhere('desc', 'LIKE', '%' . $this->filterSearch . '%');
            })
            ->Where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->with('rooms')
            ->orderBy('order')
            // ->get();
            ->paginate($this->perPage);

        return view('admin.places.manage-places', [
            'places' => $places,
        ]);
    }
}
