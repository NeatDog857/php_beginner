<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $cart = DB::table("carts")->get()->first(); // 用first() 後取得的$cart 格式是json物件
        // // 如果客戶沒有任何購物車 就建立一個空的購物車
        // if(empty($cart)){ 
        //     DB::table("carts")->insert(["created_at" => now(),
        //                                 "updated_at" => now()]);
        //     $cart = DB::table("carts")->get()->first();
        // }
        // // 購物車中要有對應的資料 也就是購物車的 read 功能
        // $cartItems = DB::table('cart_items')->where('cart_id', $cart->id)->get();
        // $cart = collect($cart);                     // 把格式還是json物件的$cart 轉為 collection
        // $cart["items"] = $cartItems;

        // 用 model 來寫
        $user = auth()->user(); // 將通過 auth middleware 的 user 資料存進 $user 變數中
        $cart = Cart::with(["cartItems"])->where("user_id", $user->id)
                                         ->firstOrCreate(["user_id" => $user->id]);
                    // with() 內的參數其實是 Cart Model 中關聯 cart_items table 的 function 名稱

        return response($cart);                     // response() 回傳的資料必須是 collection or array
    }

    public function checkout()
    {
        $user = auth()->user();
        $cart = $user->carts()->where('checked', false)->with('cartItems')->first();
        if($cart){
            $result = $cart->checkout();
            return response($result);
        }
        else{
            return response(['message' => 'cart not found'], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
