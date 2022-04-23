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
use Illuminate\Support\Arr;

use Livewire\Component;

class NewUser extends Component
{
    public $state = [];

    public function mount()
    {
        $kecamatan = Kecamatan::find(session('order.kecamatan_id'));
        $kecamatan->load('kabupaten:id,name');

        $this->state['families'] = collect(session('order.families'))->toArray();
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
        'state.families.*.name' => 'required|min:2|max:64',
        'state.families.*.birthdate' => 'required',
        'state.address' => 'required|string|min:4|max:124',
        'state.rt' => 'required|min:1|max:99',
        'state.rw' => 'required|min:1|max:99',
        'state.desa' => 'required|min:4|max:64',
        'state.phone' => 'required|min:11|max:13',
        'state.ig' => 'nullable|min:2',
        'state.email' => 'required|email|unique:users,email',
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function(){

            $newUser = Arr::where($this->state['families'], function ($item){
                return $item['type'] == 'Diri Sendiri';
            })[0];

            $user = User::create([
                'name' => $newUser['name'],
                'email' => $this->state['email'],
                'password' => Hash::make( $this->state['password']),
                'type' => User::CLIENT,
                'remember_token' => Str::random(10),
            ]);

            $user->profile()->create([
                'phone' => '62' . $this->state['phone'],
                'ig' => $this->state['ig'],
                'birthdate' => $newUser['birthdate'],
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

            $families = Arr::where($this->state['families'], function ($item){
                return $item['type'] != 'Diri Sendiri';
            });

            foreach ($families as $family)
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
        return view('order.new-user');
    }
}
