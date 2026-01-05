<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Authenticatable
{
     use HasApiTokens,  HasFactory, Notifiable, HasRoles,SoftDeletes;

       protected $table = "employees";        
   //    protected $guard_name = 'seller'; // optional but useful
   //    protected $guarded = ["name"];   /// ye db me nhi jayega field 

      
    protected $fillable = [
        'name',
        'email',
        'password',
        // etc
    ];


    //casting me db se ane ke bad data convert krta 
 protected $casts = [
    'role'=>'boolean'

 ];
    protected $hidden = [
        'password',
        'remember_token',
    ];


   

}
