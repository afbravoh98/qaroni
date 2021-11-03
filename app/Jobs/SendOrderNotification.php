<?php

namespace App\Jobs;

use App\Mail\NotificationOrder;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $event, $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, Event $event, Order $order)
    {
        $this->email = $email;
        $this->event = $event;
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notification = new NotificationOrder($this->event, $this->order);
        Mail::to($this->email)->send($notification);
    }
}
