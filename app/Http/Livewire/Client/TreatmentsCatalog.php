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
        $treatments = Treatment::query()
            ->where('category_id', 'LIKE', '%' . $this->filterCategory)
            ->active()
            ->orderBy('order')
            ->with('category')
            ->get();

        $categories = Category::query()
            ->active()
            ->orderBy('order')
            ->get();

        return view('client.treatments-catalog', [
            'treatments' => $treatments,
            'categories' => $categories,
        ]);
    }
}
