<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->isClient()) {
            return redirect()->route('home');
        }

        $view = auth()->user()->isAdmin()
            ? 'dashboard.admin'
            : 'dashboard.midwife';

        $data = $this->getData();

        return view($view, [
            'data' => $data,
        ]);
    }

    private function getData()
    {
        $data = [];

        if (auth()->user()->isAdmin()) {
            $data['new_clients'] = DB::table('users')
                ->where('type', User::CLIENT)
                ->whereMonth('created_at', now()->month)
                ->count();
            $data['unmidwife'] = DB::table('orders')
                ->where('midwife_user_id', null)
                ->count();
            $data['pending'] = DB::table('orders')
                ->where('status', Order::STATUS_UNPAID)
                ->count();
            $data['unverified'] = DB::table('payments')
                ->where('status', Payment::STATUS_UNVERIFIED)
                ->count();
        }

        if (auth()->user()->isMidwife()) {
            $data['locked'] = DB::table('orders')
                ->where('midwife_user_id', auth()->id())
                ->whereDate('date', today())
                ->where('status', Order::STATUS_LOCKED)
                ->count();

            $data['finished'] = DB::table('orders')
                ->where('midwife_user_id', auth()->id())
                ->whereDate('date', today())
                ->where('status', Order::STATUS_FINISHED)
                ->count();
        }

        return $data;
    }
}
