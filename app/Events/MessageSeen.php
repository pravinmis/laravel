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

class MessageSeen implements ShouldBroadcastNow
{
    public $message_id;
    public $group_id;
    public $sender_id;

    public function __construct($messageId, $groupId, $senderId)
    {
        $this->message_id = $messageId;
        $this->group_id = $groupId;
        $this->sender_id = $senderId;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('group.' . $this->group_id);
    }

    public function broadcastAs()
    {
        return 'message.seen';
    }
}

