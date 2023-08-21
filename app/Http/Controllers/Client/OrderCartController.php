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

        if (session()->missing('order')) {
            return redirect()->route('order.create');
        }

        if (!$this->hasSelectedLocation()){
            Notification::make()->title('Pilih lokasi dulu ya')->danger()->send();

            return redirect()->route('order.create');
        }

        return view('client.order.cart');
    }

    private function hasSelectedLocation()
    {
        return session()->has('order.place_type') || session()->has('order.place_id')
            || session()->has('order.date') || session()->has('order.kecamatan_id');
    }
}
