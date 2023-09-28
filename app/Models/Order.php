<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'user_id', // Add other fields that can be mass assigned here
        // 'book_id',
        'title',
        'name',
        'phone_number',
        "address",
        'quantity',
        'each_price',
        'total_price',
        'order_date',
        'delivery_date',
        'order_status',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('quantity'); 
    }
}
