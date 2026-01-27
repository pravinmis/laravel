<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory;

      protected $table ="products";
      protected $fillable = [
        'name',
        'price'
      ];
     
}
