<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Trang login
    public function login()
    {
        return view('auth.login');
    }

    // Trang chủ
    public function home()
    {
        return view('home');
    }

    // Xử lý đăng nhập
    public function postLogin(Request $request)
    {
        // Validate form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Lấy thông tin đăng nhập
        $credentials = $request->only('email', 'password');

        // Thử đăng nhập
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        // Sai mật khẩu hoặc email
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->withInput($request->only('email')); // Giữ lại email
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
