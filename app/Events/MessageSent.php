<?php

// app/Events/MessageSent.php
namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

// app/Events/MessageSent.php
class MessageSent implements ShouldBroadcastNow {
    use Dispatchable, SerializesModels;

    public $message;
    public $groupId;

    public function __construct(Message $message) {
        $this->message = $message->load('user');
        $this->groupId = $message->group_id;
        //dd($this->message,$this->groupId);
    }

    public function broadcastOn() {
       // dd($this->groupId);
        return new PresenceChannel('group.'.$this->groupId);
    }

    public function broadcastAs() {
        return 'group.message';
    }
}

