<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;

class Order_item extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo(\App\Models\Order::class);
    }
}
