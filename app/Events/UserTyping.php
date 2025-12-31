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

// app/Events/UserTyping.php
class UserTyping implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $fromId;
    public $toId;

    public function __construct($fromId,$toId) 
    {
       $this->toId = $toId;
      // dd($this->toId);
    }

    public function broadcastOn()
    {
        \Log::info(['name'=>$this->toId]);
        return new PrivateChannel('chat.' . $this->toId);
    }

    public function broadcastAs()
    {
        return 'user.typing';
    }
}


