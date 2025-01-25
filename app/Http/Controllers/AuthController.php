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
            return redirect()->intended(route("home"));
        }else{
            return redirect(route("login"))
                ->with("error","Đăng nhập thất bại. Vui lòng nhập lại");
        }   
    }
    
    function register(){
        return view("auth.Register");
    }
    function registerPost(Request $request){
        $request -> validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save()){
            return redirect(route("login"))
                ->with("success","Tạo tài khoản thành công");
        }else{
            return redirect(route("register"))
                ->with("error","Tạo tài khoản thất bại");
        }
    }
}
