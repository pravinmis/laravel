<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, Queueable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
       // dd($this->user);
    }

    public function handle(): void
    { 
        $user = $this->user;
        //  dd($user);
      Mail::raw("Welcome to our website!", function ($message) use ($user) {
          
        //   dd($message);
            $message->to($user->email)
            ->subject("Welcome!");
        });
       // Mail::to($this->user->email)->send(new WelcomeMail($this->user));
    }
}
