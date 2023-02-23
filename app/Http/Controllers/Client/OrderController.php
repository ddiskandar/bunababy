<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(): RedirectResponse|Redirector|View
    {
        if (auth()->check() && !auth()->user()->isClient()) {
            return redirect()->route('dashboard');
        }

        if (auth()->check() && is_null(auth()->user()->address)) {
            return redirect('/');
        }

        if (auth()->check() && (auth()->user()->latestReservation && !auth()->user()->latestReservation->isPaid())) {
            return redirect('/')->with('status', 'Anda masih punya order aktif yang belum dibayar!');
        }

        return view('client.order.create');
    }

    public function show($no_reg): View|RedirectResponse
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
