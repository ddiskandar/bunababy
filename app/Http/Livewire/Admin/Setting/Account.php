<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Option;
use App\Models\Setting;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Account extends Component
{
    use AuthorizesRequests;

    public $state = [];

    public $rules = [
        'state.account' => 'required|string|min:4|max:64',
        'state.account_name' => 'required|string|min:4|max:64',
    ];

    public $validationAttributes = [
        'state.account' => 'Nomor rekening',
        'state.account_name' => 'Nama pemilik rekening',
    ];

    public function mount()
    {
        $this->state = Option::first()->toArray();
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-settings');

            Option::where('id', 1)->update([
                'account' => $this->state['account'],
                'account_name' => $this->state['account_name'],
            ]);

            $this->emit('saved');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.setting.account');
    }
}
