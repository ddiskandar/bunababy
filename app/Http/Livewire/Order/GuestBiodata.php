<?php

namespace App\Http\Livewire\Order;

use App\Models\Address;
use App\Models\Family;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Livewire\Component;

class GuestBiodata extends Component
{
    public $state = [];

    public function mount()
    {
        $kecamatan = Kecamatan::find(session('order.kecamatan_id'));
        $kecamatan->load('kabupaten:id,name');

        $this->state['families'] = collect(session('order.families'))
            ->toArray();
        $this->state['address'] = '';
        $this->state['rt'] = '';
        $this->state['rw'] = '';
        $this->state['desa'] = '';
        $this->state['kec'] = $kecamatan->name;
        $this->state['kab'] = $kecamatan->kabupaten->name;
        $this->state['phone'] = '';
        $this->state['ig'] = '';
        // dd($this->state);
    }

    protected $rules = [
        'state.families.*.name' => 'required|min:2|max:64',
        'state.families.*.birthdate' => 'required',
        'state.address' => 'required|string|min:4|max:124',
        'state.rt' => 'required|min:1|max:99',
        'state.rw' => 'required|min:1|max:99',
        'state.desa' => 'required|min:4|max:64',
        'state.phone' => 'required|min:11|max:13',
        'state.ig' => 'nullable|min:2',
        'state.email' => 'required|email',
        'state.password' => 'required|string|confirmed|min:4',
    ];

    protected $validationAttributes = [
        'state.families.*.name' => 'Nama',
        'state.families.*.birthdate' => 'Tanggal Lahir',
        'state.address' => 'Alamat',
        'state.rt' => 'Rt',
        'state.rw' => 'Rw',
        'state.desa' => 'Desa',
        'state.phone' => 'WhatsApp',
        'state.ig' => 'User Instagram',
        'state.email' => 'Email',
        'state.password' => 'Kata sandi'
    ];

    protected $messages = [
        'state.address.required' => 'Alamat harus diisi',
        'state.families.*.birthdate.required' => 'Tanggal Lahir harus diisi',
        'state.rt.required' => 'Rt harus diisi',
        'state.rw.required' => 'Rw harus diisi',
        'state.desa.required' => 'Desa harus diisi',
        'state.phone.required' => 'WhatsApp harus diisi',
        'state.phone.min' => 'Nomor WhatsApp harus diisi setidaknya 11 karakter',
        'state.ig' => 'User Instagram',
        'state.email.required' => 'Email harus diisi',
        'state.email.email' => 'Email harus diisi dengan alamat email yang benar',
        'state.password.required' => 'Password harus diisi',
        'state.password.confirmed' => 'Password tidak sama',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function(){
            $user = User::create([
                'name' => $this->state['families'][0]['name'],
                'email' => $this->state['email'],
                'password' => Hash::make( $this->state['password']),
                'role' => 'client',
                'phone' => '62' . $this->state['phone'],
                'ig' => $this->state['ig'],
                'remember_token' => Str::random(10),
            ]);

            $address = Address::create([
                'client_user_id' => $user->id,
                'label' => 'Rumah',
                'address' => $this->state['address'],
                'rt' => $this->state['rt'],
                'rw' => $this->state['rw'],
                'desa' => $this->state['desa'],
                'kecamatan_id' => session('order.kecamatan_id'),
                'is_main' => true,
            ]);

            foreach ($this->state['families'] as $family)
            {
                Family::create([
                    'id' => $family['id'],
                    'client_user_id' => $user->id,
                    'name' => $family['name'],
                    'birth_date' => $family['birthdate'],
                    'type' => $family['type'],
                ]);
            }

            Auth::login($user);

            $this->state = [];

            return redirect()->route('order.checkout');
        });
    }

    public function render()
    {
        return view('order.guest-biodata');
    }
}
