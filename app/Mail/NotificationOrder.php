<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationOrder extends Mailable
{
    use Queueable, SerializesModels;
    protected $event, $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, Order $order)
    {
        $this->event = $event;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('orders.notification')
            ->with('order', $this->order)
            ->with('event', $this->event);
    }
}
