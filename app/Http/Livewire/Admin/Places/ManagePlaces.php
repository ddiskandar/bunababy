<?php

namespace App\Http\Livewire\Admin\Places;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Setting;
use App\Models\Place;

class ManagePlaces extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $perPage = 5;

    public $showDialog = false;

    public $filterSearch;
    public $filterStatus;

    public $state = [];


    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 5],
        'filterStatus' => ['except' => ''],
    ];

    protected $rules = [
        'state.name' => 'required|min:3|max:32',
        'state.desc' => 'required|min:3|max:255',
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.desc' => 'Deskripsi',
    ];

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
    }

    public function ShowEditPlaceDialog(Place $place)
    {
        $this->state = $place->toArray();
        foreach ($this->places as $place) {
            $this->state['prices'][$place->id] = $place->prices->where('place_id', $place->id)->value('amount');
        }
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-places');

            Place::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? Place::max('id') + 1,
                ],
                [
                    'name' => $this->state['name'],
                    'desc' => $this->state['desc'],
                    'type' => Place::TYPE_CLINIC,
                    'order' => Place::max('order') + 1,
                    'active' => false,
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
