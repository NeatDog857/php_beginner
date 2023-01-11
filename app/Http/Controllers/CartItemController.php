<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateCartItem;
use App\Http\Requests\StoreCartItem;
use App\Models\Cart;
use App\Models\CartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreCartItem $request)
    {
        $validatedForm = $request->validated();

        // DB::table("cart_items")->insert(["cart_id" => $form["cart_id"],
        //                                 "product_id" => $form["product_id"],
        //                                 "quantity" => $form["quantity"],
        //                                 "created_at" => now(),
        //                                 "updated_at" => now()]);
        // 使用 model 來寫
        $cart = Cart::find($validatedForm["cart_id"]);
        $newCart = $cart->cartItems()->create(["product_id" => $validatedForm["product_id"],
                                               "quantity" => $validatedForm["quantity"]]);
        return response()->json($newCart);
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
     *         改為使用 App\Http\Requests\UpdateCartItem $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartItem $request, $id) //改為使用 App\Http\Requests\UpdateCartItem $request
    {
        //
        $validatedForm = $request->validated();
        // DB::table("cart_items")->where("id", $id)
        //                        ->update(["quantity" => $form["quantity"],
        //                                  "updated_at" => now()]);
        // 使用 model 來寫
        $cartItem = CartItem::find($id);
        $cartItem->fill(["quantity" => $validatedForm["quantity"]]);
        $cartItem->save();
        return response()->json($cartItem);
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
        // DB::table("cart_items")->where("id", $id)
        //                        ->delete();
        // 使用 model 來寫
        CartItem::find($id)->delete(); // CartItem model 中已經使用 laravel softDeletes
                                       // 再透過 model 執行的 delete() 會自動在組合後的
                                       // sql 語法中去添加 deleted_at 欄位的時間軸 而非真正刪除
        
        // 若是要在添加 softDeletes 套件後使用 model 語法來實現真正的刪除方法如下
        // CartItem::withTrashed()->find($id)->forceDelete();
            // 因為一般的 find() 會去自動過濾 (deleted_at != NULL) 的邏輯
            // 所以 withTrashed() 是為了要讓 model 能去找出被軟刪除的資料
            // forceDelete() 則是可以直接執行真正的 sql 語法 delete 來實現真正的刪除
        return response()->json(true);
    }
}
