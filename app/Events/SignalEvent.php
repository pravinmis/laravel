<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class SignalEvent implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $room;
    public $userId;
    public $data;

    public function __construct($room, $userId, $data)
    {
        $this->room = $room;
        $this->userId = $userId;
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('room.' . $this->room);
    }
}
