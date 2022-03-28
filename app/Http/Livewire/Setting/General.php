<?php

namespace App\Http\Livewire\Setting;

use App\Models\Option;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class General extends Component
{
    public $state = [];

    public $rules = [
        'state.site_name' => 'required',
        'state.site_location' => 'required',
        'state.site_desc' => 'required',
        'state.ig' => 'required',
    ];

    public function mount()
    {
        $this->state = Option::first()->toArray();
    }

    public function save()
    {
        $this->validate();

        Option::where('id', 1)->update([
            'site_name' => $this->state['site_name'],
            'site_location' => $this->state['site_location'],
            'site_desc' => $this->state['site_desc'],
            'ig' => $this->state['ig'],
        ]);

        $this->emit('saved');

    }

    public function render()
    {
        return view('settings.general');
    }
}
