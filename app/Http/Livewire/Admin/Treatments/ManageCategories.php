<?php

namespace App\Http\Livewire\Admin\Treatments;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Treatment;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ManageCategories extends Component
{
    use AuthorizesRequests;

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

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.description' => 'Desc',
        'state.order' => 'Urutan',
    ];

    public function showAddNewCategoryDialog()
    {
        $this->resetErrorBag();
        $this->showDialog = true;
        $this->state = [];
        $this->state['order'] = Category::max('id') + 1;
        $this->state['active'] = true;
    }

    public function ShowEditCategoryDialog(Category $category)
    {
        $this->resetErrorBag();
        $this->state = $category->toArray();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-treatments');

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

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->Where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->withCount('treatments')
            ->get();

        return view('admin.treatments.manage-categories', [
            'categories' => $categories
        ]);
    }
}
