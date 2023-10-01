<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Controllers\API\UserController;
use App\Controllers\API\WishlistController;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
       

    ];

    protected $hidden = [
        'address',
        'country',
        'city',
        'street',
        'phone_number',
        'password',
        'remember_token',
        'updated_at', 
        'created_at',
        'id'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public $guard_name = 'api';

    public function books()
    {
      return $this->hasMany(Book::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function carts()
{
    return $this->hasMany(Cart::class);
}

public function newsletters()
{
    return $this->hasMany(Newsletter::class);
}

}
