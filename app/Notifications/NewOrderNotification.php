<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class NewOrderNotification extends Notification
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
        $this->order->load('treatments', 'client', 'midwife');

        $order_treatments = '';
        $treatments = $this->order->treatments->toArray();

        foreach ($treatments as $key => $treatment) {

            $order_treatments .= $treatment['name'];

            if($key != array_key_last($treatments)) {
                $order_treatments .= ', ';
            }
        }

        return [
            'type' => 'order',
            'order_id' => $this->order->id,
            'order_datetime' => $this->order->startDateTime->isoFormat('dddd, DD MMMM gggg HH:mm - ') . $this->order->endDateTime->isoFormat('HH:mm') . ' WIB',
            'order_grand_total' => rupiah($this->order->getGrandTotal()),
            'order_dp_amount' => rupiah($this->order->getDpAmount()),
            'order_treatments' => $order_treatments,
            'order_dp_timeout' => $this->order->created_at->addMinutes($timeout)->isoFormat('dddd, DD MMMM gggg HH:mm'),
            'order_client_name' => $this->order->client->name,
            'order_client_phone' => to_wa_indo($this->order->client->profile->phone),
            'order_client_address_name' => $this->order->client->address,
            'order_midwife_name' => $this->order->midwife->name ?? '-',
        ];
    }
}
