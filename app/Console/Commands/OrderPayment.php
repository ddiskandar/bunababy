<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Notification;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\OrderUnpaidNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OrderPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check payment of order';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::locked()
            // ->doesntHave('payments')
            ->whereDoesntHave('payments', function ($query) {
                $query->where('status', Payment::STATUS_VERIFIED)
                    ->orWhere('status', Payment::STATUS_UNVERIFIED);
            })
            ->get();

        $timeout = DB::table('options')->first()->timeout;

        $users = User::query()
            ->where('type', User::ADMIN)
            ->orWhere('type', User::OWNER)
            ->get();

        foreach ($orders as $order) {

            if (!$order->isPaid() && (now()->gt($order->created_at->addMinutes($timeout)))) {

                $order->update(['status' => Order::STATUS_UNPAID]);

                Notification::send($users, new OrderUnpaidNotification($order));
            }
        }
    }
}
