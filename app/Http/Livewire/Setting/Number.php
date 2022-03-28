<?php

namespace App\Http\Livewire\Setting;

use App\Models\Option;
use Livewire\Component;

class Number extends Component
{
    public $state = [];

    public $rules = [
        'state.wa_admin' => 'required',
        'state.wa_owner' => 'required',
    ];

    public function mount()
    {
        $this->state = Option::first()->toArray();
    }

    public function save()
    {
        $this->validate();

        Option::where('id', 1)->update([
            'wa_admin' => $this->state['wa_admin'],
            'wa_owner' => $this->state['wa_owner'],
        ]);

        $this->emit('saved');

    }

    public function render()
    {
        return view('settings.number');
    }
}
