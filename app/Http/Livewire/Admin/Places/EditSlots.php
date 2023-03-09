<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use App\Models\Slot;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditSlots extends Component
{
    public $place;
    public $time;

    protected $rules = [
        'time' => 'required'
    ];

    protected $validationAttributes = [
        'time' => 'Wilayah'
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Place $place)
    {
        $this->place = $place;
    }

    public function add()
    {
        $this->validate();
        $this->place->slots()->create([
            'time' => $this->time
        ]);
        $this->emit('saved');
    }

    public function delete($id)
    {
        $slot = Slot::find($id);
        $slot->delete();
        $this->emit('saved');
    }

    public function render()
    {
        $slots = $this->place->slots()->orderBy('time')->get();
        return view('admin.places.edit-slots', [
            'slots' => $slots
        ]);
    }
}
