<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Seller extends Authenticatable
{
     use  HasFactory, Notifiable, HasRoles;

       protected $table = "sellers";        
       protected $guard_name = 'seller'; // optional but useful
   //    protected $guarded = ["name"];


    protected $fillable = [
        'name',
        'email',
        'password',
        // etc
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


   

}
