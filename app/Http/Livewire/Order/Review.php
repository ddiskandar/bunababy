<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class Review extends Component
{
    public $order;

    public $rate = 5;
    public $description;

    protected $validationAttributes = [
        'description' => 'Deskripsi ulasan',
        'rate' => 'Rating',
    ];

    public function mount(Order $reservation)
    {
        $this->order = $reservation;
    }

    public function rate($i)
    {
        $this->rate = $i;
    }

    public function save()
    {
        $this->validate([
            'rate' => 'required|in:1,2,3,4,5',
            'description' => 'required|min:4|max:512',
        ]);

        $this->order->testimonial()->updateOrCreate(
            [
                'order_id' => $this->order->id,
            ],
            [
                'rate' => $this->rate,
                'description' => $this->description,
            ]
        );

        return to_route('testimonial.show', $this->order->no_reg);
    }

    public function render()
    {
        return view('order.review');
    }
}
