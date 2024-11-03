<?php

namespace App\Http\Controllers\Midwife;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ShowOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Order $order)
    {
        return view('midwife.order.show', compact('order'));
    }
}
