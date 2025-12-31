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
    use Dispatchable, SerializesModels;
     public $fromId;

    public function __construct($fromId) {
        
        $this->fromId = $fromId;
       // dd($this->fromId);
    }

    public function broadcastOn()
    {   
         \Log::info(['messageseen'=>$this->fromId ]);

        return new PrivateChannel('chat.' . $this->fromId);
    }

    public function broadcastAs()
    {
        return 'message.seen';
    }
}
