<?php

namespace App\Http\Livewire\Treatments;

use App\Models\Category;
use App\Models\Treatment;
use Filament\Notifications\Notification;
use Livewire\Component;

class ManageCategories extends Component
{
    public $showDialog = false;

    public $filterStatus;

    public $state = [];

    protected $queryString = [];

    protected $rules = [
        'state.name' => 'required',
        'state.description' => 'nullable',
        'state.order' => 'required',
        'state.active' => 'required',
    ];

    protected $messages = [];

    protected $validationAttributes = [];

    public function showAddNewCategoryDialog()
    {
        $this->showDialog = true;
        $this->state = [];
        $this->state['order'] = Category::max('id') + 1;
        $this->state['active'] = true;
    }

    public function ShowEditCategoryDialog(Category $category)
    {
        $this->state = $category->toArray();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        Category::updateOrCreate(
            [
                'id' => $this->state['id'] ?? Category::max('id') + 1,
            ],
            [
                'name' => $this->state['name'],
                'description' => $this->state['description'] ?? '',
                'order' => $this->state['order'],
                'active' => $this->state['active'],
            ]
        );

        $this->showDialog = false;
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function render()
    {
        $categories = Category::query()
            ->Where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->withCount('treatments')
            ->get();

        return view('treatments.manage-categories', [
            'categories' => $categories
        ]);
    }
}
