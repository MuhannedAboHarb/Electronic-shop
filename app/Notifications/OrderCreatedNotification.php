<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order ;      //

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)       //
    {
        $this->order = $order ;         //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array  //اهم دالة
    {
        return ['mail' , 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $order = $this->order ;
        $billing = $order->addresses()->where('type' , '=' ,'billing')->first();
        $line1 = "{$billing->first_name} {$billing->last_name} has placed a new order (#{$order->number}) on your store" ;
        return (new MailMessage)
                    ->from('m@muhaned.ps' , 'EStore Billing Account ')
                    ->subject('New Order #' . $order->number )
                    ->greeting("Hi $notifiable->name,") // سطر ترحيبي
                    ->line($line1)
                    ->action('View Order', url('/dashboard/order/' . $order->id)) //زر يظهر بالرسالة عند الضغط عليه يحولك لمكان معين
                    ->line('Thank you for using our application!'); //
    }

     /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
        $order = $this->order ;
        $billing = $order->addresses()->where('type' , '=' ,'billing')->first();
        $line1 = "{$billing->first_name} {$billing->last_name} has placed a new order (#{$order->number}) on your store" ;
        return [
            // Basic Notification Data
            'title' => 'New Order #' . $this->order->number  ,
            'body' => $line1 ,
            'image' => '' ,
            'url' => url('/dashboard/order/' . $order->id) ,
            // Custom Data
            'order' => $this->order ,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
