<?php

namespace App\Http\Livewire\Setting;

use App\Models\Option;
use Livewire\Component;

class General extends Component
{
    public $state = [];

    public $rules = [
        'state.site_name' => 'required|string|min:4|max:64',
        'state.site_location' => 'required|string|min:4|max:25',
        'state.site_desc' => 'required|string|min:4|max:255',
        'state.ig' => 'required|string|min:4|max:64',
        'state.phone' => 'required|string|min:9|max:13',
    ];

    protected $validationAttributes = [
        'state.site_name' => 'Nama',
        'state.site_location' => 'Lokasi',
        'state.site_desc' => 'Deskripsi',
        'state.ig' => 'Username IG',
        'state.phone' => 'Nomor WA Admin',
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
            'phone' => $this->state['phone'],
        ]);

        $this->emit('saved');
    }

    public function render()
    {
        return view('settings.general');
    }
}
