<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\User;

class SendWelcomeEmail extends Command
{
    protected $signature = 'email:daily';
    protected $description = 'Send daily email directly (no job)';

    public function handle()
    {
        $users = User::get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(
                new WelcomeMail($user)
            );
        }

        $this->info('Daily emails sent successfully');
    }
}
