<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Post extends Model
{
       use HasFactory;    // <-- ye zaroor add karo

     protected $fillable = ['user_id','title','body','image'];



    public function categories(){
    
       return $this->BelongsToMany(\App\Models\Categorie::class)->withTimestamps();
    }
    public function user(){
        return $this->belongsTo(\App\Models\User::class);

    }

     public function seller(){
           return  $this->belongsTo(\App\Models\Seller::class);
     }
}
