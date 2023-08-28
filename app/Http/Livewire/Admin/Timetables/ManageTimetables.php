<?php

namespace App\Http\Livewire\Admin\Timetables;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Timetable;
use App\Models\Place;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;

class ManageTimetables extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $perPage = 8;
    public $midwives;
    public $places;

    public $showDialog = false;

    public $filterSearch;
    public $filterType;
    public $filterMidwife;
    public $selectedMonth;

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
        'state.date' => 'required|date',
        'state.type' => 'required',
        'state.place_id' => 'required_if:state.type,3',
        'state.note' => 'nullable',
    ];

    protected $validationAttributes = [
        'state.midwife_user_id' => 'bidan',
        'state.date' => 'tanggal',
        'state.type' => 'tipe',
        'state.place_id' => 'tempat',
        'state.note' => 'catatan',
    ];

    public function mount()
    {
        $this->midwives = User::active()->midwives()->get();
        $this->places = Place::active()->clinics()->get();
        $this->selectedMonth = today()->isoFormat('YYYY-MM');
    }

    public function prevMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)->subMonth()->isoFormat('YYYY-MM');
    }

    public function nextMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)->addMonth()->isoFormat('YYYY-MM');
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
        $this->errorBag = null;
        $this->showDialog = true;
        $this->state = [];
    }

    public function ShowEditTimetableDialog(Timetable $timetable)
    {
        $this->state = $timetable->toArray();
        $this->state['date'] = $timetable->date->toDateString();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-timetables');

            Timetable::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? Timetable::max('id') + 1,
                ],
                [
                    'midwife_user_id' => $this->state['midwife_user_id'],
                    'date' => $this->state['date'],
                    'type' => $this->state['type'],
                    'place_id' => $this->state['place_id'] ?? null,
                    'note' => $this->state['note'] ?? '',
                ]
            );

            $this->showDialog = false;

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function delete(Timetable $timetable)
    {
        try {
            $this->authorize('manage-timetables');

            $timetable->delete();

            Notification::make()->title(Setting::DELETED_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        $timetables = Timetable::query()
            ->where('note', 'LIKE', '%' . $this->filterSearch . '%')
            ->where('midwife_user_id', 'LIKE', '%' . $this->filterMidwife . '%')
            ->where('type', 'LIKE', '%' . $this->filterType . '%')
            ->when(auth()->user()->isMidwife(), function ($query) {
                $query->where('midwife_user_id', auth()->id());
            })
            ->whereMonth('date', Carbon::parse($this->selectedMonth)->month)
            ->with('midwife', 'place')
            ->orderBy('date', 'ASC')
            ->paginate($this->perPage);

        return view('admin.timetables.manage-timetables', [
            'timetables' => $timetables,
        ]);
    }
}
