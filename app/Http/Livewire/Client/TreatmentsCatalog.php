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
            ->when($this->filterCategory !== '',
                fn ($query) => $query->where('category_id',  $this->filterCategory),
            )
            ->orderBy('order')
            ->select('id', 'name', 'desc', 'duration', 'category_id')
            ->with('category:id,name')
            ->get();

        $categories = Category::active()
            ->select('id', 'name')
            ->orderBy('order')
            ->get();

        return view('client.treatments-catalog', [
            'treatments' => $treatments,
            'categories' => $categories,
        ]);
    }
}
