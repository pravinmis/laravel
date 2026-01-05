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
class UserTyping implements ShouldBroadcastNow {
use Dispatchable, SerializesModels;

    public $user;
    public $groupId;

    public function __construct($user, $groupId) {
       // dd($user, $groupId);
        $this->user = $user;
        $this->groupId = $groupId;
    }

    public function broadcastOn() {
      //dd($this->user);
        \Log::info(['group_id'=>$this->groupId]);

        return new PresenceChannel('group.'.$this->groupId);
    }

    public function broadcastAs() {
        return 'typing';
    }
}
