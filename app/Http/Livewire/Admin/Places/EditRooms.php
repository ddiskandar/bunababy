<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use App\Models\Room;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditRooms extends Component
{
    public $place;

    public $state = [];

    public $showDialog = false;

    protected $rules = [
        'state.name' => 'required|string|min:3|max:32',
    ];

    protected $validationAttributes = [
        'state.name' => 'Nama Ruangan'
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Place $place)
    {
        $this->place = $place;
    }

    public function showAddNewRoomDialog()
    {
        $this->showDialog = true;
        $this->state = [];
        $this->state['active'] = true;
    }

    public function showEditRoomDialog(Room $room)
    {
        $this->state = $room->toArray();
        $this->showDialog = true;
    }

    public function save()
    {
        $this->validate();

        Room::updateOrCreate(
            [
                'id' => $this->state['id'] ?? Room::max('id') + 1,
            ],
            [
                'name' => $this->state['name'],
                'place_id' => $this->place->id,
                'active' => $this->state['active'] ?? false,
            ]
        );

        $this->emit('saved');

        $this->showDialog = false;

        Notification::make()
            ->title('berhasil disimpan')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('admin.places.edit-rooms', [
            'rooms' => $this->place->rooms,
        ]);
    }
}
