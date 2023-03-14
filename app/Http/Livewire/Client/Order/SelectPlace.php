<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Place;
use Livewire\Component;

class SelectPlace extends Component
{
    public int $selectedPlace;
    public $places;

    public function mount()
    {
        $this->places = Place::active()->orderAsc()->select('id', 'name', 'desc', 'type')->get();

        if (session()->missing('order.place_id') || session()->missing('order.place_type')) {
            $this->savePlaceInSession();
        }

        $this->selectedPlace = session('order.place_id');
    }

    public function updatedSelectedPlace()
    {
        $this->savePlaceInSession();
        return redirect()->route('order.create');
    }

    private function savePlaceInSession()
    {
        $place = Place::find($this->selectedPlace ?? $this->places->first()->id);
        session()->put('order.place_id', $place->id);
        session()->put('order.place_type', $place->type);
        session()->put('order.place_transport_duration', $place->transport_duration);
    }

    public function render()
    {
        return view('client.order.select-place');
    }
}
