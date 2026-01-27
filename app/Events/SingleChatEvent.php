<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SingleChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $toUserId;
    public $fromId;

    public function __construct($fromId,$toUserId,$message)
    {
        $this->toUserId = $toUserId;
        $this->message = $message;
        $this->fromId = $fromId;
    }

    public function broadcastOn()
{
    return [
        // receiver ko
        new PrivateChannel('single-chat.' . $this->toUserId),

        // sender ko bhi
        new PrivateChannel('single-chat.' . $this->fromId),
    ];
}

    public function broadcastAs()
    {
        return 'message.single';
    }
}
