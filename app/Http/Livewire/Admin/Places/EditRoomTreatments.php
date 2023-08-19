<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Place;
use App\Models\Room;
use App\Models\Setting;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditRoomTreatments extends Component
{
    use AuthorizesRequests;

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

        try {
            $this->authorize('manage-places');

            $this->room->treatments()->attach([$this->treatmentId]);
            $this->treatmentId = '';
            $this->emit('saved');

            Notification::make()->title('Berhasil disimpan')->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function delete($id)
    {
        try {
            $this->authorize('manage-places');

            $this->room->treatments()->detach([$id]);
            $this->emit('saved');

            Notification::make()->title('Berhasil disimpan')->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function deleteThisRoom()
    {
        try {
            $this->authorize('manage-places');

            $this->room->delete();

            $this->emit('saved');
            Notification::make()->title('Berhasil dihapus')->danger()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
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
