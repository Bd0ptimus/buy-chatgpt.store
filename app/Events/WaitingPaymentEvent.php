<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WaitingPaymentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    protected $checkoutCode;
    protected $message;

    public function __construct($checkoutCode, $message)
    {
        $this->checkoutCode = $checkoutCode;
        $this->message = $message;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public.payment.'.$this->checkoutCode);
        // return new Channel('public.payment.1');

    }

    public function broadcastAs(){
        return 'payment-complete';
    }

    public function broadcastWith(){
        return [
            'message' => $this->message,
        ];
    }
}
