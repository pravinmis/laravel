<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminNotification implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $message;
    protected $adminId;

    public function __construct($adminId, $message)
    {
        $this->adminId = $adminId;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('admin.' . $this->adminId);
    }

    public function broadcastAs()
    {
        return 'admin.notification';
    }
}

