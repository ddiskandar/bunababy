<?php

namespace App\Http\Livewire\Admin\Places;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Livewire\Component;
use App\Models\Place;
use App\Models\Setting;
use App\Models\Slot;

class EditSlots extends Component
{
    use AuthorizesRequests;

    public $place;
    public $time;

    protected $rules = [
        'time' => 'required'
    ];

    protected $validationAttributes = [
        'time' => 'Slot Waktu'
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Place $place)
    {
        $this->place = $place;
    }

    public function add()
    {
        $this->validate();

        try {
            $this->authorize('manage-places');

            $this->place->slots()->create([
                'time' => $this->time
            ]);

            $this->reset('time');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function delete($id)
    {
        try {
            $this->authorize('manage-places');

            $slot = Slot::find($id);
            $slot->delete();

            Notification::make()->title(Setting::DELETED_MESSAGE)->danger()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        $slots = $this->place->slots()->orderBy('time')->get();
        return view('admin.places.edit-slots', [
            'slots' => $slots
        ]);
    }
}
