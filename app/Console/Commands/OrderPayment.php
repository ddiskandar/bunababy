<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Notification;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderUnpaid;
use Illuminate\Console\Command;

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
        $orders = Order::where('status', Order::STATUS_LOCKED)
            ->get();
        foreach ($orders as $order) {

            if(! $order->paid() && (now()->gt($order->created_at->addMinutes(30))) ) {

                $order->update([
                    'status' => Order::STATUS_UNPAID,
                ]);

                $users = User::query()
                    ->where('type', User::ADMIN)
                    ->orWhere('type', User::OWNER)
                    ->get();

                Notification::send($users, new OrderUnpaid($order));
            }
        }
    }
}
