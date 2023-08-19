<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Option;
use App\Models\Setting as ModelsSetting;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Setting extends Component
{
    use AuthorizesRequests;

    public $state = [];

    public $rules = [
        'state.timeout' => 'required|numeric',
    ];

    public $validationAttributes = [
        'state.timeout' => 'Batas waktu DP',
    ];

    public function mount()
    {
        $this->state = Option::first()->toArray();
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('edit-settings');

            Option::where('id', 1)->update([
                'timeout' => $this->state['timeout'],
            ]);

            $this->emit('saved');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(ModelsSetting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.setting.setting');
    }
}
