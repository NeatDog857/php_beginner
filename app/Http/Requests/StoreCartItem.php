<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartItem extends APIRequest // 繼承自訂的 APIRequest 來過濾掉 FormRequest 中預設錯誤後會返回上一頁的功能
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "cart_id" => "required",
            "product_id" => "required",
            "quantity" => "required|integer|gt:0"
        ];
    }
}