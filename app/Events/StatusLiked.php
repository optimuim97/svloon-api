<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatusLiked
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct($username)
    {
        $this->username = $username;
        $this->message  = "{$username} liked your status";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('status-liked'),
        ];
    }
}
