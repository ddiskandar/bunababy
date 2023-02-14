<?php

namespace App\Http\Livewire\Clients;

use App\Models\Tag;
use Filament\Notifications\Notification;
use Livewire\Component;

class ManageTags extends Component
{
    public $showDialog = false;

    public $filterStatus;

    public $state = [];
    protected $queryString = [];

    protected $rules = [
        'state.name' => 'required',
        'state.description' => 'nullable',
        'state.active' => 'required',
    ];

    protected $messages = [];

    protected $validationAttributes = [];

    public function showAddNewTagDialog()
    {
        $this->showDialog = true;
        $this->state = [];
        $this->state['active'] = true;
    }

    public function showEditTagDialog(Tag $tag)
    {
        $this->state = $tag->toArray();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        Tag::updateOrCreate(
            [
                'id' => $this->state['id'] ?? Tag::max('id') + 1,
            ],
            [
                'name' => $this->state['name'],
                'description' => $this->state['description'] ?? '',
                'active' => $this->state['active'],
            ]
        );

        $this->showDialog = false;
        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();
    }

    public function render()
    {
        $tags = Tag::query()
            ->where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->withCount('clients')
            ->get();

        return view('clients.manage-tags', [
            'tags' => $tags
        ]);
    }
}
