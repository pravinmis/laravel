<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Order_item;

class Order extends Model
{
    use HasFactory;

 protected    $fillable = [
        'oder_date',
    ];


    public function user(){
        return  $this->belongsTo(\App\Models\User::class);
    }
    public function order_items(){
        return  $this->hasMany(\App\Models\Order_item::class);
    }
}
