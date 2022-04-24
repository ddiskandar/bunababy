<?php

namespace App\Http\Livewire\Order;

use App\Models\Address;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewAddress extends Component
{
    public $state = [];

    public function mount()
    {
        $kecamatan = Kecamatan::find(session('order.kecamatan_id'));
        $kecamatan->load('kabupaten:id,name');

        $this->state['address'] = '';
        $this->state['rt'] = '';
        $this->state['rw'] = '';
        $this->state['desa'] = '';
        $this->state['kec'] = $kecamatan->name;
        $this->state['kab'] = $kecamatan->kabupaten->name;
        $this->state['phone'] = '';
        $this->state['ig'] = '';
    }

    protected $rules = [
        'state.address' => 'required|string|min:4|max:124',
        'state.rt' => 'required|min:1|max:99',
        'state.rw' => 'required|min:1|max:99',
        'state.desa' => 'required|min:4|max:64',
    ];

    protected $validationAttributes = [
        'state.address' => 'Alamat',
        'state.rt' => 'Rt',
        'state.rw' => 'Rw',
        'state.desa' => 'Desa',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        Address::create([
            'client_user_id' => auth()->id(),
            'label' => 'Alamat Baru',
            'address' => $this->state['address'],
            'rt' => $this->state['rt'],
            'rw' => $this->state['rw'],
            'desa' => $this->state['desa'],
            'kecamatan_id' => session('order.kecamatan_id'),
            'is_main' => true,
        ]);

        $this->state = [];

        return redirect()->route('order.checkout');
    }

    public function render()
    {
        return view('order.new-address');
    }
}
