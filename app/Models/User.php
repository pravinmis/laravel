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
use App\Mail\WelcomeMail;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
 //    protected   $guarded = ['name'];  ye kbhi fill nhi hoga store hoga field db me 
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

     protected $appends = ['image_url']; // important  isko tb use krte hai jb ko new field appnd krna ho tb 
     


        public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtoupper($value);
    }

public function getNameAttribute($value)
{
    //dd($value);
    return strtoupper($value);
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
    

/////// isko model events kahate hai 2 method hote hai ek ye automatic  send krta hai ya iska oberver banakar krte hai bs vo alg file me hota hai 
 // ✅ MODEL EVENTS
    protected static function boot()
    {
        parent::boot();

        // Before Insert
        static::creating(function ($user) {
            $user->created_by = auth()->id() ?? 1;
        });
        //  static::created(function ($user) {
        //    \Mail::to($user->email)->send(new WelcomeMail($user));
        // });
        // // Before Update
        // static::updating(function ($user) {
        //     $user->updated_by = auth()->id() ?? 1;
        // });
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
