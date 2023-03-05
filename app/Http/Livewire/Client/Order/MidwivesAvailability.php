<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MidwivesAvailability extends Component
{
    public $kecamatan;
    public $midwives;
    public $availableMidwives;
    public $notAvailableMidwives;

    protected $listeners  = [
        'locationChanged',
    ];

    public function mount()
    {

        if (session()->has('order.kecamatan_id')) {

            $this->kecamatan = Kecamatan::query()
                ->where('id', session('order.kecamatan_id'))
                ->select('id', 'name')
                ->with([
                    'midwives' => fn ($query) => $query->active(),
                    'midwives.profile'
                ])
                ->first();

            $this->availableMidwives = User::query()
                ->midwives()->active()
                ->whereIn('id', $this->kecamatan->midwives->pluck('id'))
                ->pluck('id');

            $this->notAvailableMidwives = User::query()
                ->midwives()->active()
                ->with('profile')
                ->whereNotIn('id', $this->kecamatan->midwives->pluck('id'))
                ->select('id', 'name')
                ->get();
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
