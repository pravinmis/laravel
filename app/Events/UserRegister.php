<?php

namespace App\Events;

use App\Models\User;
Use App\Model\Employee;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegister
{
    use Dispatchable, SerializesModels;

    public $user;

    public function __construct($user)
    {  //  dd($user);
        $this->user = $user;
    }
}
