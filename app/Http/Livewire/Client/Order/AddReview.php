<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use App\Models\Setting;
use Filament\Notifications\Notification;
use Livewire\Component;

class AddReview extends Component
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

    public function save()
    {
        $this->validate([
            'rate' => 'required|in:1,2,3,4,5',
            'description' => 'required|min:4|max:512',
        ]);

        try {
            $this->order->testimonial()->updateOrCreate(
                [
                    'order_id' => $this->order->id,
                ],
                [
                    'rate' => $this->rate,
                    'description' => $this->description,
                ]
            );
            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

            return to_route('client.testimonial', $this->order->id);

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('client.order.add-review');
    }
}
