<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Treatment;
use Livewire\Component;

class TreatmentCatalog extends Component
{
    public $family_id;

    public function mount()
    {
        $this->family_id = time();
    }

    public function addTreatment(Treatment $treatment) {

        if(session()->missing('order.addMinutes')) {
            session()->put('order.addMinutes', 40);
        }

        session()->increment('order.addMinutes', $treatment->duration);

        session()->push('order.treatments', [
            'treatment_id' => $treatment->id,
            'family_id' => $this->family_id,
        ]);

        $this->emit('treatmentAdded');

    }

    public function addFamily()
    {
        session()->push('order.families', [
            'id' => $this->family_id,
            'name' => 'pulan',
            'type'=> 'buna',
        ]);
    }

    public function render()
    {
        $categories = Category::query()
            ->with('treatments', function($query){
                $query->whereHidden(false);
            })->get();

        return view('livewire.treatment-catalog', [
            'categories' => $categories,
        ]);
    }
}
