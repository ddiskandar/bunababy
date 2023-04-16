<?php

namespace App\Listeners;

use App\Events\NewPaymentCreated;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Notifications\NewPaymentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewPaymentNotification
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
    public function handle(NewPaymentCreated $event): void
    {
        $users = User::query()
            // ->where('type', User::OWNER)
            ->orWhere('type', User::ADMIN)
            ->get();

        Notification::send($users, new NewPaymentNotification($event->payment));
    }
}
