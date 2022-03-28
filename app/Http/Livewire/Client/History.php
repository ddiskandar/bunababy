<?php

namespace App\Http\Livewire\Client;

use App\Models\Order;
use Livewire\Component;

class History extends Component
{
    public $filterStatus = '';

    public function render()
    {
        $reservations = Order::query()
            ->where('client_user_id', auth()->id())
            ->where('status', 'like', '%' . $this->filterStatus . '%' )
            ->get();

        return view('client.history.history', [
            'reservations' => $reservations,
        ]);
    }
}
