<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // 👈 ADD THIS

class UserRegisteredNotification extends Notification implements ShouldBroadcast // 👈 ADD THIS
{
    use Queueable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->user->name . ' has registered',
            'user_id' => $this->user->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        \Log::info(['broadcasting_user_id' => $this->user->id]);

        return new BroadcastMessage([
            'message' => $this->user->name . ' has registered',
            'user_id' => $this->user->id,
        ]);
    }
}
