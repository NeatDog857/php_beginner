<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::Class);
    }

    public function order()
    {
        return $this->hasOne(Order::Class);
    }

    public function checkout()
    {
        $order = $this->order()->create(['user_id' => $this->user_id]);
        foreach ($this->cartItems as $cartItem)
        {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'price' => ($cartItem->quantity)*($cartItem->product->price)
            ]);
        }
        $this->update(['checked' => true]);
        $order->orderItems;
        return $order;
    }
}
