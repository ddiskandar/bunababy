<?php

namespace App\Http\Livewire\Setting;

use App\Models\Option;
use Livewire\Component;

class Number extends Component
{
    public $state = [];

    public $rules = [
        'state.wa_admin' => 'required|string|min:11|max:13',
        'state.wa_owner' => 'required|string|min:11|max:13',
    ];

    public $validationAttributes = [
        'state.wa_admin' => 'WA Admin',
        'state.wa_owner' => 'WA Owner',
    ];

    public function mount()
    {
        $option = Option::find(1);
        $this->state = $option->toArray();

        if(substr($this->state['wa_admin'], 0, 2) == '08'){
            $option->update([
                'wa_admin' => substr_replace($this->state['wa_admin'], '62', 0, 1),
            ]);
        }

        if(substr($this->state['wa_owner'], 0, 2) == '08'){
            $option->update([
                'wa_owner' => substr_replace($this->state['wa_owner'], '62', 0, 1),
            ]);
        }
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
