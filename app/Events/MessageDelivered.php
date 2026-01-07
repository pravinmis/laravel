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

class MessageDelivered implements ShouldBroadcastNow {
    use Dispatchable, SerializesModels;
    public $messageId;
    public $groupId;

    public function __construct($messageId,$groupId){
        //  dd($messageId,$groupId);
        $this->messageId = $messageId;
        $this->groupId = $groupId;
    
    }

    public function broadcastOn(){
        return new PresenceChannel('group.'.$this->groupId);
    }

    public function broadcastAs(){
        return 'message.delivered';
    }
}
