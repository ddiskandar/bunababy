<?php

namespace App\Http\Livewire\Client\Order;

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
        $this->state['desa'] = '';
        $this->state['kec'] = $kecamatan->name;
        $this->state['kab'] = $kecamatan->kabupaten->name;
        $this->state['phone'] = '';
        $this->state['ig'] = null;
    }

    protected $rules = [
        'state.families.*.name' => 'required|min:2|max:64',
        'state.families.*.dob' => 'required',
        'state.address' => 'required|string|min:4|max:124',
        'state.desa' => 'required|min:4|max:64',
        'state.phone' => 'required|min:11|max:14',
        'state.ig' => 'nullable|min:2',
        'state.email' => 'required|email|unique:users,email',
        'state.password' => 'required|string|confirmed|min:6',
    ];

    protected $validationAttributes = [
        'state.families.*.name' => 'Nama',
        'state.families.*.dob' => 'Tanggal Lahir',
        'state.address' => 'Alamat',
        'state.desa' => 'Desa',
        'state.phone' => 'WhatsApp',
        'state.ig' => 'User Instagram',
        'state.email' => 'Email',
        'state.password' => 'Kata sandi'
    ];

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {

            $newUser = Arr::where($this->state['families'], function ($item) {
                return $item['type'] === 'Diri Sendiri';
            })[0];

            $user = User::create([
                // 'id' => User::max('id') + 1,
                'name' => $newUser['name'],
                'email' => $this->state['email'],
                'password' => Hash::make($this->state['password']),
                'type' => User::CLIENT,
                'remember_token' => Str::random(10),
            ]);

            $user->profile()->create([
                'phone' => $this->state['phone'],
                'ig' => $this->state['ig'] ?? null,
                'dob' => $newUser['dob'],
            ]);

            $address = Address::create([
                'client_user_id' => $user->id,
                'label' => 'Rumah',
                'address' => $this->state['address'],
                'desa' => $this->state['desa'],
                'kecamatan_id' => session('order.kecamatan_id'),
                'is_main' => true,
            ]);

            $families = Arr::where($this->state['families'], function ($item) {
                return $item['type'] !== 'Diri Sendiri';
            });

            foreach ($families as $family) {
                Family::create([
                    'id' => $family['id'],
                    'client_user_id' => $user->id,
                    'name' => $family['name'],
                    'dob' => $family['dob'],
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
        return view('client.order.new-user');
    }
}
