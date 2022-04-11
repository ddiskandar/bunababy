<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Treatment;
use Livewire\Component;

class TreatmentsCatalog extends Component
{
    public $filterCategory = '';

    public function render()
    {
        $treatments = Treatment::query()
            ->where('category_id', 'LIKE', '%' . $this->filterCategory)
            ->get();

        $categories = Category::all();


        return view('treatments-catalog', [
            'treatments' => $treatments,
            'categories' => $categories,
        ]);
    }
}
