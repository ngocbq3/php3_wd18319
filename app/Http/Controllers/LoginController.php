<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    //Login
    public function postLogin(Request $request)
    {
        $data = $request->only(['email', 'password']);

        //Kiểm tra tài khoản có trong CSDL không
        if (Auth::attempt($data)) {
            return redirect()->route('post.index');
        } else {
            return redirect()->back()->with('errorLogin', 'Email hoặc Password không chính xác');
        }
    }
    public function register()
    {
        return view('register');
    }

    //Register
    public function postRegister(Request $request)
    {
        $data = $request->all();
        User::query()->create($data);
        return redirect()->route('login')->with('message', 'Đăng ký tài khoản thành công');
    }

    //Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
