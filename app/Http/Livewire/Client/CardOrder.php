<?php

namespace App\Http\Livewire\Client;

use App\Models\Order;
use Livewire\Component;

class CardOrder extends Component
{
    public $reservation;

    public $route;
    public $label;

    public function mount(Order $reservation)
    {
        $this->$reservation = $reservation;

        $this->route = route('order.show', $this->reservation->id);

        if ($this->reservation->status == '1'){
            $this->label = 'Bayar DP';
        } elseif (! $reservation->isPaid()){
            $this->label = 'Lunasi Pembayaran';
        } elseif ($reservation->status == '2' && $reservation->isPaid()){
            $this->label = 'Lihat Treatment';
        } elseif ($reservation->testimonial()->exists()){
            $this->label = 'Lihat Ulasan';
            $this->route = route('client.testimonial', $this->reservation->id);
        } else {
            $this->label = 'Beri Ulasan';
            $this->route = route('client.testimonial', $this->reservation->id);
        }
    }

    public function render()
    {
        return view('client.card-order');
    }
}
