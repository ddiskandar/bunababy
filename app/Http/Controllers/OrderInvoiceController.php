<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class OrderInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GeneralSettings $settings, Order $order)
    {
        $order->load('treatments');

        return view('print.order.invoice', [
            'order' => $order,
            'settings' => $settings,
        ]);
    }
}
