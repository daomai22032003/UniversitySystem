<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function index()
    {
        return view('index');
    }
    public function sidebar()
    {
        return view('sidebar');
    }
    public function postLogin(LoginRequest $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/');
        }

        return redirect()->route('login')->with('error', 'Sai tài khoản hoặc mật khẩu')->withInput();
    }
    
    
    }
