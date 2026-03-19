<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
//    public function Register() {
//
//    }

    public function LoginView()
    {
        return view('auth.login');
    }

    public function Login(StoreLoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended("/");
        }
        return back()->withErrors(['email' => "Такого пользователя не существует"]);
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }
}
