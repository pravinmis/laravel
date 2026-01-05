<?php

namespace App\Events;

use App\Models\User;
Use App\Model\Employee;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class UserRegister implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $user;

    public function __construct($user)
    {  //  dd($user);
        $this->user = $user;
    }

    public function broadcastOn()
    {
        \Log::info(['user'=>$this->user]);
        return new PrivateChannel('chat.' .$this->user);
    }

    public function broadcastAs()
    {
        return 'user.login';
    }
}
