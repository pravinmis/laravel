<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = "user_profiles";
    protected $fillable = [
                   'name',
                   'email',
                   'mobile',
                   'profile_pic',
                     'password'
    ];
}
