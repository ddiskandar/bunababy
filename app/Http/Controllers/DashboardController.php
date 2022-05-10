<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function show()
    {
        if(auth()->user()->isClient())
        {
            return redirect()->route('me');
        }

        $data['jumlah_midwives'] = DB::table('users')->where('type', User::MIDWIFE)->count();
        $data['jumlah_clients'] = DB::table('users')->where('type', User::CLIENT)->count();
        $data['jumlah_order_selesai'] = DB::table('orders')->count();

        return view('dashboard.show', [
            'data' => $data
        ]);
    }
}
