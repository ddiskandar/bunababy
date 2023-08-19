<?php

namespace App\Http\Livewire\Admin\Midwives;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Setting;
use App\Models\User;

class EditWilayahMidwife extends Component
{
    use AuthorizesRequests;

    public $midwife;
    public $kecamatanId = '';

    protected $rules = [
        'kecamatanId' => 'required'
    ];

    protected $validationAttributes = [
        'kecamatanId' => 'Wilayah'
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

            $this->midwife->kecamatans()->attach([$this->kecamatanId]);
            $this->kecamatanId = '';
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

            $this->midwife->kecamatans()->detach([$id]);
            $this->emit('saved');
            Notification::make()->title(Setting::DELETED_MESSAGE)->danger()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        $kecamatans = $this->midwife->kecamatans;

        $kecamatansFiltered = DB::table('kecamatans')
            ->whereNotIn('id', $this->midwife->kecamatans->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.midwives.edit-wilayah-midwife', [
            'kecamatans' => $kecamatans,
            'kecamatansFiltered' => $kecamatansFiltered
        ]);
    }
}
