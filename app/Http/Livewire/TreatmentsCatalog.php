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
            ->orderBy('order')
            ->with('category')
            ->get();

        $categories = Category::query()
            ->orderBy('order')
            ->get();


        return view('treatments-catalog', [
            'treatments' => $treatments,
            'categories' => $categories,
        ]);
    }
}
