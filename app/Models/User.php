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
        'address',
        'country',
        'city',
        'street',
        'phone_number',

    ];

    protected $hidden = [
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
}
