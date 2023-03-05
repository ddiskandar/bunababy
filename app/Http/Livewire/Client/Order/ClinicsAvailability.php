<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Kecamatan;
use App\Models\Place;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClinicsAvailability extends Component
{
    public $place;
    public $rooms = [];

    protected $listeners  = ['locationChanged'];

    public function mount()
    {
        $this->place = Place::find(session('order.place_id'));

        $this->rooms = Room::query()
            ->active()
            ->with('place')
            ->where('place_id', session('order.place_id'))
            ->get();
    }

    public function locationChanged()
    {
        return redirect()->route('order.create');
    }

    public function render()
    {
        return view('client.order.clinics-availability');
    }
}
