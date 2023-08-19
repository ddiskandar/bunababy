<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use App\Models\Setting;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditPlace extends Component
{
    use AuthorizesRequests;
    public $place;

    public $state = [];

    protected function rules()
    {
        return [
            'state.name' => 'required|string|min:2|max:32',
            'state.desc' => 'required|string|min:2|max:64',
            'state.active' => 'required',
        ];
    }

    protected $validationAttributes = [
        'state.name' => 'Nama',
        'state.desc' => 'Deskripsi',
        'state.active' => 'Status',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Place $place)
    {
        $this->place = $place;
        $this->state = $place->toArray();
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-places');

            $this->place->update([
                'name' => $this->state['name'],
                'desc' => $this->state['desc'],
                'active' => $this->state['active'],
            ]);

            $this->emit('saved');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.places.edit-place');
    }
}
