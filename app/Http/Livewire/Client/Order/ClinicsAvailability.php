<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Place;
use App\Models\Room;
use Livewire\Component;

class ClinicsAvailability extends Component
{
    public $place;
    public $rooms;

    protected $listeners = ['locationChanged'];

    public function mount()
    {
        $this->place = Place::find(session('order.place_id'));
        $this->place->load('slots');

        $this->rooms = Room::query()
            ->active()
            ->where('place_id', session('order.place_id'))
            ->get();
    }

    public function locationChanged()
    {
        return to_route('order.create');
    }

    public function render()
    {
        return view('client.order.clinics-availability');
    }
}
