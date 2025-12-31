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
class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message->load('user');
      //  dd($this->message);
    }

    public function broadcastOn()
    {
        \Log::info(['messagesend'=>$this->message->to_id]);

        return new PrivateChannel('chat.' . $this->message->to_id);
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}
