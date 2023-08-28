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
            ->where('status', 'like', '%' . $this->filterStatus . '%')->get();

        $hasActiveReservation = Order::query()
            ->where('client_user_id', auth()->id())
            ->where(fn ($query) => $query
                ->where('status', Order::STATUS_LOCKED)
                ->orWhere('status', Order::STATUS_UNPAID)
            )->exists();

        return view('client.history.history', [
            'reservations' => $reservations,
            'hasActiveReservation' => $hasActiveReservation,
        ]);
    }
}
