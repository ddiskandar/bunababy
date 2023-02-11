<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create()
    {
        if (auth()->check() and !auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if (auth()->check() and is_null(auth()->user()->address)) {
            return redirect('/');
        }

        if (auth()->check() and (auth()->user()->latestReservation and !auth()->user()->latestReservation->isPaid())) {
            return redirect('/')->with('status', 'Anda masih punya order aktif yang belum dibayar!');
        }

        return view('client.order.create');
    }

    public function cart()
    {
        if (auth()->check() and !auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if (auth()->check()) {
            session()->put('order.status', 'AuthUser');
        }

        if (session()->missing('order.kecamatan_id') or session()->missing('order.place') or session()->missing('order.date')) {
            return redirect()->route('order.create');
        }

        return view('client.order.cart');
    }

    public function check()
    {
        session()->put('order.status', 'newUser');
        return to_route('order.cart');
    }

    public function checkout()
    {
        if (auth()->check() and !auth()->user()->isClient()) {
            return to_route('dashboard');
        }

        if (session()->missing('order.kecamatan_id') or session()->missing('order.place') or session()->missing('order.date') or session()->missing('order.start_time_id') or session()->missing('order.treatments')) {
            return to_route('order.cart');
        }

        if (auth()->check()) {

            $address = auth()->user()->addresses->where('kecamatan_id', session('order.kecamatan_id'))->first();

            if ($address) {
                session()->put('order.address_id', $address->id);
            }
        }

        return view('client.order.checkout');
    }

    public function show($no_reg)
    {
        $order = Order::query()
            ->with('treatments')
            ->where('no_reg', $no_reg)
            ->firstOrFail();

        if (!auth()->check() or $order->client_user_id != auth()->id()) {
            return to_route('home');
        }

        $isPaid = $order->isPaid();
        $dp =  $order->dp();
        $hasPayments = $order->payments()->exists();
        $hasTestimonial = $order->testimonial()->exists();
        $options = DB::table('options')->select('account', 'account_name', 'site_location')->first();

        return view('client.order.show', [
            'order' => $order,
            'options' => $options,
            'isPaid' => $isPaid,
            'hasPayments' => $hasPayments,
            'dp' => $dp,
            'hasTestimonial' => $hasTestimonial,
        ]);
    }
}
