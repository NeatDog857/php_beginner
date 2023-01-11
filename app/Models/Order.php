<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::Class);
    }

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::Class);
    }
}