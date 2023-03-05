<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Filament\Notifications\Notification;

class OrderCartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        if (auth()->check() && !auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if (auth()->check()) {
            session()->put('order.status', 'AuthUser');
        }

        if (session()->missing('order.place_type') || session()->missing('order.place_id') || session()->missing('order.date') || session()->missing('order.kecamatan_id')) {
            Notification::make()
                ->title('Pilih lokasi dulu ya')
                ->success()
                ->send();

            return redirect()->route('order.create');
        }

        return view('client.order.cart');
    }
}
