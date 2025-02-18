<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(){
        return view("auth.Login");
    }
    function loginPost(Request $request){
        $request -> validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $request->only("email", "password");
        if(Auth::attempt($credentials)){
            // dd(Auth::user());
            return redirect()->intended(route("Home.index"))->with("successLogin","Đăng nhập thành công");
        }else{
            return redirect(route("login"))
                ->with("errorLogin","Thông tin tài khoản, hoặc mật khẩu không chính xác!");
        }   
    }
    
    function register(){
        return view("auth.Register");
    }
    function registerPost(Request $request){
        $request -> validate([
            "name" => "required",
            "email" => "required|unique:users,email",
            "password" => "required",
        ],
        [
            "email.unique"=>"email đã tồn tại!",
        ]
    );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "user";

        if($user->save()){
            return redirect(route("login"))
                ->with("successRegister","Tạo tài khoản thành công");
        }else{
            return redirect(route("register"))
                ->with("errorRegister","Tạo tài khoản thất bại");
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route("Home.index");
    }
    public function Unauthorized(){
        return view("abortPage.404");
    }
}
