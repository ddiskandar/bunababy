<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Kecamatan;
use App\Models\Slot;
use App\Models\User;
use Livewire\Component;

class MidwivesAvailability extends Component
{
    public $kecamatan;
    public $midwives;
    public $slots;

    protected $listeners = ['locationChanged'];

    public function mount()
    {
        if (session()->has('order.kecamatan_id')) {
            $this->kecamatan = Kecamatan::query()
                ->where('id', session('order.kecamatan_id'))
                ->select('id', 'name')
                ->with('midwives:id')
                ->first();

            $this->slots = Slot::query()
                ->where('place_id', session('order.place_id'))
                ->get();

            $midwives = User::query()
                ->midwives()->active()
                ->with('profile:user_id,photo')
                ->select('id', 'name')
                ->get();

            $this->midwives['available'] = $midwives->whereIn('id', $this->kecamatan->midwives->pluck('id'));
            $this->midwives['notAvailable'] = $midwives->whereNotIn('id', $this->kecamatan->midwives->pluck('id'));
        }
    }

    public function locationChanged()
    {
        return redirect()->route('order.create');
    }

    public function render()
    {
        return view('client.order.midwives-availability');
    }
}
