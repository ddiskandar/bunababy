<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditRooms extends Component
{
    public $place;

    protected $rules = [
    ];

    protected $validationAttributes = [
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Place $place)
    {
        $this->place = $place;
    }

    public function add()
    {
        $this->validate();
        //
        $this->emit('saved');
    }

    public function delete($id)
    {

        $this->emit('saved');
    }

    public function render()
    {
        $rooms = $this->place->rooms;

        $filteredTreatments = DB::table('treatments')
            // ->whereNotIn('id', $this->place->rooms->treatments->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.places.edit-rooms', [
            'rooms' => $rooms,
            'filteredTreatments' => $filteredTreatments
        ]);
    }
}
