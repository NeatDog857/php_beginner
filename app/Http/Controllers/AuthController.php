<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserSignUp;
use App\Http\Requests\UserLogIn;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function signup(UserSignUp $request)
    {
        $validatedForm = $request->validated();
        User::create(["name" => $validatedForm["name"],
                      "email" => $validatedForm["email"],
                      "password" => bcrypt($validatedForm["password"])]);
        return response("success",201);
    }

    public function login(UserLogIn $request)
    {
        $validatedForm = $request->validated();
        /**
         * 使用 Auth 套件
         * attempt() 會去嘗試利用驗證後的表單登入
         * 也就是去搜尋 database 中有沒有對應的帳號密碼
         */
        
        if(!Auth::attempt($validatedForm)){
            return response("login failed",401);
        }
        
        /**
         * 找到對應的帳號密碼成功登入之後
         * 則會把在 database 中找到的對應 user 資料給放入變數 $request 中
         * 需要使用 user() 方法取出
         */
        $user = $request->user();
        // $user = Auth::user();
        $tokenResult = $user->createToken("Token");
        $tokenResult->token->save();
        return response(["token" => $tokenResult->accessToken]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(["message" => "logout successfully"]);
    }

    public function user(Request $request)
    {
        return response($request->user());
    }


}
