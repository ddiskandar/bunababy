<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use App\Models\Room;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditRoomTreatments extends Component
{
    public $room;
    public $treatmentId = '';

    protected $rules = [
        'treatmentId' => 'required'
    ];

    protected $validationAttributes = [
        'treatmentId' => 'Treatment'
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Room $room)
    {
        $room->load('treatments');
        $this->room = $room;
    }

    public function add()
    {
        $this->validate();
        $this->room->treatments()->attach([$this->treatmentId]);
        $this->treatmentId = '';
        $this->emit('saved');
    }

    public function delete($id)
    {
        $this->room->treatments()->detach([$id]);
        $this->emit('saved');
    }

    public function deleteThisRoom()
    {
        $this->room->delete();

        $this->emit('saved');
        Notification::make()
            ->title('berhasil dihapus')
            ->danger()
            ->send();
    }

    public function render()
    {
        $filteredTreatments = DB::table('treatments')
            ->whereNotIn('id', $this->room->treatments->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.places.edit-room-treatments', [
            'filteredTreatments' => $filteredTreatments
        ]);
    }
}
