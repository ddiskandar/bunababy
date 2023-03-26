<?php

namespace App\Http\Livewire\Client;

use App\Models\Category;
use App\Models\Treatment;
use Livewire\Component;

class TreatmentsCatalog extends Component
{
    public $filterCategory = '';

    public function render()
    {
        $treatments = Treatment::active()
            ->where('category_id', 'LIKE', '%' . $this->filterCategory)
            ->orderBy('order')
            ->select('id', 'name', 'desc', 'duration', 'category_id')
            ->with('category:id,name')
            ->get();

        $categories = Category::active()
            ->orderBy('order')
            ->get();

        return view('client.treatments-catalog', [
            'treatments' => $treatments,
            'categories' => $categories,
        ]);
    }
}
