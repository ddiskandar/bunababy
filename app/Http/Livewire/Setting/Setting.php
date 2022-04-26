<?php

namespace App\Http\Livewire\Setting;

use App\Models\Option;
use Livewire\Component;

class Setting extends Component
{
    public $state = [];

    public $rules = [
        'state.timeout' => 'required|numeric',
        'state.transport_duration' => 'required|numeric',
    ];

    public $validationAttributes = [
        'state.timeout' => 'Batas waktu DP',
        'state.transport_duration' => 'Durasi Transport',
    ];

    public function mount()
    {
        $this->state = Option::first()->toArray();
    }

    public function save()
    {
        $this->validate();

        Option::where('id', 1)->update([
            'timeout' => $this->state['timeout'],
            'transport_duration' => $this->state['transport_duration'],
        ]);

        $this->emit('saved');
    }

    public function render()
    {
        return view('setting.setting');
    }
}
