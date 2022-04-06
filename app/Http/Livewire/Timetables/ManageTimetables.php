<?php

namespace App\Http\Livewire\Timetables;

use App\Models\Timetable;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTimetables extends Component
{
    use WithPagination;

    public $perPage = 3;

    public $showDialog = false;
    public $successMessage = false;

    public $filterSearch;
    public $filterCategory;
    public $filterStatus;

    public $state = [];

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 3],
        'filterCategory' => ['except' => ''],
        'filterStatus' => ['except' => ''],
    ];

    protected $rules = [
        'state.name' => 'required',
        'state.desc' => 'required',
        'state.price' => 'required',
        'state.duration' => 'required',
        'state.order' => 'required',
        'state.category_id' => 'required',
        'state.active' => 'required',
    ];

    protected $messages = [
        //
    ];

    protected $validationAttributes = [
        'state.name' => 'nama',
        'state.desc' => 'deskripsi',
        'state.price' => 'harga',
        'state.duration' => 'durasi',
        'state.order' => 'urutan',
        'state.category_id' => 'kategori',
        'state.active' => 'status aktif',
    ];

    public function save()
    {
        $this->validate();

        $this->showDialog = false;
        $this->successMessage = true;
    }

    public function render()
    {
        $timetables = Timetable::query()

        ->paginate($this->perPage);

        return view('timetables.manage-timetables', [
            'timetables' => $timetables,
        ]);
    }
}
