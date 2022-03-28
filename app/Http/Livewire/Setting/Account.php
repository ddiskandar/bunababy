<?php

namespace App\Http\Livewire\Setting;

use App\Models\Option;
use Livewire\Component;

class Account extends Component
{
    public $state = [];

    public $rules = [
        'state.account' => 'required',
        'state.account_name' => 'required',
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
        return view('settings.account');
    }
}
