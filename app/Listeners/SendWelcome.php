<?php

namespace App\Listeners;

use App\Events\UserRegister;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class SendWelcome
{
    public function handle(UserRegister $event)
    {
        $user = $event->user;
      //  dd($user);
        // NO QUEUE — mail sent immediately
        Mail::raw("Welcome to our website!", function ($message) use ($user) {
            $message->to($user->email)
            ->subject("Welcome!");
        });

      //Mail::to($event->user->email)->send(new WelcomeMail($event->user));
    }
}
