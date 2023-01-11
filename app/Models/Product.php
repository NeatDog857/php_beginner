<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function cartItems()
    {
        return $this->hasMany(CartItem::Class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::Class);
    }
}