<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
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

        $data = [];

        if(auth()->user()->isMidwife()){
            $data['locked'] = DB::table('orders')->where('midwife_user_id', auth()->id())->whereDate('start_datetime', today())->where('status', Order::STATUS_LOCKED)->count();
            $data['finished'] = DB::table('orders')->where('midwife_user_id', auth()->id())->whereDate('start_datetime', today())->where('status', Order::STATUS_FINISHED)->count();
        }

        if(auth()->user()->isAdmin()){
            $data['new_clients'] = DB::table('users')->where('type', User::CLIENT)->whereMonth('created_at', now()->month)->count();
            $data['pending'] = DB::table('orders')->where('status', Order::STATUS_UNPAID)->count();
            $data['unverified'] = DB::table('payments')->where('status', Payment::STATUS_UNVERIFIED)->count();
        }

        return view('dashboard.show', [
            'data' => $data
        ]);
    }
}
