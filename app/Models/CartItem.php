<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes; // 使用 laravel 軟刪除套件

class CartItem extends Model
{
    use HasFactory;
    use SoftDeletes; // 使用 laravel 軟刪除套件

    protected $guarded = ["id"];
    
    public function product()
    {
        return $this->belongsTo(Product::Class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}