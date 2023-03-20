<?php

namespace App\Http\Livewire\Client;

use App\Models\Order;
use Livewire\Component;

class History extends Component
{
    public $filterStatus = '';

    public function render()
    {
        $query = Order::query()
            ->where('client_user_id', auth()->id())
            ->where('status', 'like', '%' . $this->filterStatus . '%');

        $reservations = $query->get();

        $hasActiveReservation = $query->where('status', Order::STATUS_LOCKED)->count() > 0;

        return view('client.history.history', [
            'reservations' => $reservations,
            'hasActiveReservation' => $hasActiveReservation,
        ]);
    }
}
