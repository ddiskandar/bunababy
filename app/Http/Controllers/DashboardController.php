<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->isClient()) {
            return redirect()->route('home');
        }

        $data = [];

        if (auth()->user()->isMidwife()) {
            $data['locked'] = DB::table('orders')->where('midwife_user_id', auth()->id())->whereDate('date', today())->where('status', Order::STATUS_LOCKED)->count();
            $data['finished'] = DB::table('orders')->where('midwife_user_id', auth()->id())->whereDate('date', today())->where('status', Order::STATUS_FINISHED)->count();

            return view('dashboard.midwife', [
                'data' => $data,
            ]);
        }

        if (auth()->user()->isAdmin()) {
            $data['new_clients'] = DB::table('users')->where('type', User::CLIENT)->whereMonth('created_at', now()->month)->count();
            $data['unmidwife'] = DB::table('orders')->where('midwife_user_id', NULL)->count();
            $data['pending'] = DB::table('orders')->where('status', Order::STATUS_UNPAID)->count();
            $data['unverified'] = DB::table('payments')->where('status', Payment::STATUS_UNVERIFIED)->count();

            return view('dashboard.admin', [
                'data' => $data
            ]);
        }
    }
}
