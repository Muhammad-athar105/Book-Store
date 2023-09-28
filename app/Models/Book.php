<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Controllers\API\WishlistController;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'image'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    // Relationship
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
    
    public function add_to_cart()
{
    return $this->belongsToMany(Cart::class)->withPivot('quantity'); 
}

    // Relationship
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function ratings()
    {
      return $this->hasMany(Rating::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
}
