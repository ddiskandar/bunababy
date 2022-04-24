<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderInvoiceController extends Controller
{
    public function __invoke(Order $order)
    {
        $options = DB::table('options')->first();

        return view('client.order.invoice', [
            'order' => $order,
            'options' => $options,
        ]);
    }
}
