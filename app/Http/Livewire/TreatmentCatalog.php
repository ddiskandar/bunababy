<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Treatment;
use Livewire\Component;

class TreatmentCatalog extends Component
{
    public function add(Treatment $treatment) {

        session()->push('order.treatments',[
            'treatment_id' => $treatment->id,
            'family_name' => 'pulan',
        ]);

    }

    public function render()
    {
        $categories = Category::query()
            ->with('treatments')
            ->get();

        return view('livewire.treatment-catalog', [
            'categories' => $categories,
        ]);
    }
}
