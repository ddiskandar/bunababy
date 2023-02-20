<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Option;
use Livewire\Component;

class Account extends Component
{
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

        Option::where('id', 1)->update([
            'account' => $this->state['account'],
            'account_name' => $this->state['account_name'],
        ]);

        $this->emit('saved');
    }

    public function render()
    {
        return view('admin.setting.account');
    }
}
