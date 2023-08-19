<?php

namespace App\Http\Livewire\Admin\Midwives;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Setting;
use App\Models\User;

class EditMidwifeTreatments extends Component
{
    use AuthorizesRequests;

    public $midwife;
    public $treatmentId = '';

    protected $rules = [
        'treatmentId' => 'required'
    ];

    protected $validationAttributes = [
        'treatmentId' => 'Treatment'
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->midwife = $user;
    }

    public function add()
    {
        $this->validate();

        try {
            $this->authorize('manage-midwives');

            $this->midwife->treatments()->attach([$this->treatmentId]);
            $this->treatmentId = '';
            $this->emit('saved');
            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function delete($id)
    {
        try {
            $this->authorize('manage-midwives');

            $this->midwife->treatments()->detach([$id]);
            $this->emit('saved');
            Notification::make()->title(Setting::DELETED_MESSAGE)->danger()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        $treatments = $this->midwife->treatments;

        $treatmentsFiltered = DB::table('treatments')
            ->whereNotIn('id', $this->midwife->treatments->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.midwives.edit-midwife-treatments', [
            'treatments' => $treatments,
            'treatmentsFiltered' => $treatmentsFiltered
        ]);
    }
}
