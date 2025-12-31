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

class MessageDelivered implements ShouldBroadcastNow
{   
    use Dispatchable, SerializesModels;
    
    public $messageId;
    public $userId;

    public function __construct($messageId,$userId)
     {
                $this->messageId = $messageId;
                $this->userId = $userId;
    }

    public function broadcastOn()
    {
        \Log::info(['delivered'=>$this->userId , 'messageId'=>$this->messageId]);
        return new PrivateChannel('chat.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'message.delivered';
    }
}
