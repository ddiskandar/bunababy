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
        if( auth()->check() AND ! auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if( auth()->check() AND is_null(auth()->user()->address)) {
            return redirect('/me');
        }

        if( auth()->check() AND (auth()->user()->latestReservation AND ! auth()->user()->latestReservation->isPaid())){
            return redirect('/me')->with('status', 'Anda masih punya order aktif yang belum dibayar!');
        }

        return view('client.order.create');
    }

    public function cart()
    {
        if(auth()->check() AND ! auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if( session()->missing('order.midwife_user_id') OR session()->missing('order.place') OR session()->missing('order.kecamatan_id') OR session()->missing('order.date')) {
            return redirect()->route('order.create');
        }

        return view('client.order.cart');
    }

    public function checkout()
    {
        if(auth()->check() AND ! auth()->user()->isClient()) {
            return to_route('dashboard');
        }

        if( session()->missing('order.midwife_user_id') OR session()->missing('order.place') OR session()->missing('order.kecamatan_id') OR session()->missing('order.date') OR session()->missing('order.start_time_id') OR session()->missing('order.treatments') ) {
            return to_route('order.cart');
        }

        if(auth()->check()){

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
            ->where('no_reg', $no_reg)
            ->firstOrFail();

        if(! auth()->check() OR $order->client_user_id != auth()->id() ) {
            return to_route('me');
        }

        $isPaid = $order->isPaid();
        $dp =  $order->dp();
        $hasPayments = $order->payments()->exists();
        $hasTestimonial = $order->testimonial()->exists();
        $options = DB::table('options')->select('account', 'account_name')->first();

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
