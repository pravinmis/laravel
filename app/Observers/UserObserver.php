<?php

namespace App\Observers;

use App\Models\User;
use App\Mail\WelcomeMail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */

     // ✅ MODEL EVENT
    public function creating(User $user)
    {
        $user->created_by = auth()->id() ?? 1;
    }

    public function created(User $user): void
    {
        \Mail::to($user->email)->send(new WelcomeMail($user));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
