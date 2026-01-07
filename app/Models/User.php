<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;
use App\Models\Order;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

     protected $appends = ['image_url']; // important
     


        public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtoupper($value);
    }


    

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/uploads/' . $this->image);
        }

        return asset('default.png'); // fallback
    }


    // public function getProfileAttribute()
    // {
    //     return route('updates', $this->id);
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    

     
    public function profile(){
        return $this->hasOne(\App\Models\Profile::class);
    }
    public function posts(){
        return $this->hasMany(\App\Models\Post::class);
    }

    public function orders(){
        return $this->hasMany(\App\Models\Order::class);
    }
}
