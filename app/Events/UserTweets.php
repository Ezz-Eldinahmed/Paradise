<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserTweets
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $body;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($body, $user)
    {
        $this->body = $body;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
