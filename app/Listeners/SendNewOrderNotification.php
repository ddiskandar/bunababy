<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderNotification;

class SendNewOrderNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewOrderCreated $event): void
    {
        $users = User::query()
            // ->where('type', User::OWNER)
            ->orWhere('type', User::ADMIN)
            ->get();

        Notification::send($users, new NewOrderNotification($event->order));
    }
}
