<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class OrderUnpaid extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $timeout = DB::table('options')->first()->timeout;

        return [
            'type' => 'unpaid',
            'order_id' => $this->order->id,
            'order_client_name' => $this->order->client->name,
            'order_client_phone' => to_wa_indo($this->order->client->profile->phone),
            'order_no_reg' => $this->order->no_reg,
            'order_dp_amount' => rupiah($this->order->getDpAmount()),
            'order_dp_timeout' => $this->order->created_at->addMinutes($timeout)->isoFormat('dddd, DD MMMM gggg HH:mm'),

        ];
    }
}
