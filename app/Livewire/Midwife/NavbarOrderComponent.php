<?php

namespace App\Livewire\Midwife;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class NavbarOrderComponent extends Component
{
    public Order $order;

    #[On('order-updated')]
    public function justRefreshThePage()
    {
        //
    }

    public function render()
    {
        return view('livewire.midwife.navbar-order-component');
    }
}
