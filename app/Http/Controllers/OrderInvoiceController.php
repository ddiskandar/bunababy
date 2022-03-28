<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderInvoiceController extends Controller
{
    public function __invoke(Order $order)
    {
        return view('client.order.invoice', [
            'order' => $order,
        ]);
    }
}
