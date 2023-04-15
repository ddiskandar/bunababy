<?php

namespace App\Http\Livewire\Admin\Treatments;

use App\Models\Place;
use App\Models\Price;
use App\Models\Treatment;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTreatments extends Component
{
    use WithPagination;

    public $perPage = 3;

    public $showDialog = false;

    public $filterSearch;
    public $filterCategory;
    public $filterStatus;

    public $state = [];
    public $places = [];

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 3],
        'filterCategory' => ['except' => ''],
        'filterStatus' => ['except' => ''],
    ];

    protected $rules = [
        'state.name' => 'required|min:3',
        'state.desc' => 'required',
        'state.duration' => 'required|numeric',
        'state.order' => 'required|numeric',
        'state.category_id' => 'required|numeric',
        'state.active' => 'required|boolean',
        'state.prices.*' => 'required|numeric'
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.desc' => 'Deskripsi',
        'state.duration' => 'Durasi',
        'state.order' => 'Urutan',
        'state.category_id' => 'Kategori',
        'state.active' => 'Status',
        'state.prices.*' => 'Harga',
    ];

    public function mount()
    {
        $this->places = Place::active()->orderAsc()->get();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFilterSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatedStateCategoryId()
    {
        $this->state['order'] = Treatment::where('category_id', $this->state['category_id'])->max('order') + 1;
    }

    public function showAddNewTreatmentDialog()
    {
        $this->showDialog = true;
        $this->state = [];
        $this->state['active'] = true;
    }

    public function ShowEditTreatmentDialog(Treatment $treatment)
    {
        $this->state = $treatment->toArray();
        foreach ($this->places as $place) {
            $this->state['prices'][$place->id] = $treatment->prices->where('place_id', $place->id)->value('amount');
        }
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $treatment = Treatment::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? Treatment::max('id') + 1,
                ],
                [
                    'category_id' => $this->state['category_id'],
                    'name' => $this->state['name'],
                    'duration' => $this->state['duration'],
                    'desc' => $this->state['desc'],
                    'order' => $this->state['order'],
                    'active' => $this->state['active'],
                ]
            );

            foreach ($this->state['prices'] as $placeId => $amount) {
                Price::updateOrCreate(
                    [
                        'treatment_id' => $this->state['id'] ?? $treatment->id,
                        'place_id' => $placeId,
                    ],
                    [
                        'amount' => $amount,
                    ]
                );
            }
        });

        $this->showDialog = false;
        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();
    }

    public function render()
    {
        $treatments = Treatment::query()
            ->where(function ($query) {
                $query
                    ->where('name', 'LIKE', '%' . $this->filterSearch . '%')
                    ->orWhere('desc', 'LIKE', '%' . $this->filterSearch . '%')
                    ->orWhere('duration', 'LIKE', '%' . $this->filterSearch . '%');
            })
            ->Where('category_id', 'LIKE', '%' . $this->filterCategory . '%')
            ->Where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->with('category', 'prices', 'prices.place')
            ->orderBy('category_id')->orderBy('order')
            ->paginate($this->perPage);

        return view('admin.treatments.manage-treatments', [
            'treatments' => $treatments,
            'categories' => DB::table('categories')->get()
        ]);
    }
}
