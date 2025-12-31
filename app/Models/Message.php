<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{



  protected $fillable = [
        'from_id','to_id','message',
        'delivered_at','seen_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'from_id');
    }
   
}


    