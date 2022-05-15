<?php

namespace App\Http\Livewire\Timetables;

use App\Models\Timetable;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTimetables extends Component
{
    use WithPagination;

    public $perPage = 8;
    public $midwives;

    public $showDialog = false;
    public $successMessage = false;

    public $filterSearch;
    public $filterType;
    public $filterMidwife;

    public $state = [];

    protected $queryString = [
        'page' => ['except' => 1],
        'perPage' => ['except' => 8],
        'filterSearch' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterMidwife' => ['except' => ''],
    ];

    protected $rules = [
        'state.midwife_user_id' => 'required',
        'state.date' => 'required',
        'state.type' => 'required',
        'state.note' => 'nullable',
    ];

    protected $validationAttributes = [
        'state.midwife_user_id' => 'bidan',
        'state.date' => 'tanggal',
        'state.type' => 'tipe',
        'state.note' => 'catatan',
    ];

    public function mount()
    {
        $this->midwives = User::active()->where('type', User::MIDWIFE)->get();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFilterSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterMidwife()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function showAddNewTimetableDialog()
    {
        $this->showDialog = true;
        $this->state = [];
    }

    public function ShowEditTimetableDialog( Timetable $timetable)
    {
        $this->state = $timetable->toArray();
        $this->state['date'] = $timetable->date->toDateString();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        Timetable::updateOrCreate(
            [
                'id' => $this->state['id'] ?? Timetable::max('id') + 1,
            ],
            [
                'midwife_user_id' => $this->state['midwife_user_id'],
                'date' => $this->state['date'],
                'type' => $this->state['type'],
                'note' => $this->state['note'] ?? '',
            ]
        );

        $this->showDialog = false;
        $this->successMessage = true;
    }

    public function render()
    {
        $timetables = Timetable::query()
            ->when(auth()->user()->isMidwife(), function ($query){
                $query->where('midwife_user_id', auth()->id());
            })
            ->paginate($this->perPage);

        return view('timetables.manage-timetables', [
            'timetables' => $timetables,
        ]);
    }
}
