<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::user())
        {
            return redirect('/home');
        }

        $data = array(
            'title'  => 'Halaman Login',
        );

        return view('Auth.login', $data);
    }

    public function cek_login(Request $request)
    {
        $password = $request->input('password');
        $email = $request->input('email');

        if(Auth::guard('web')->attempt(['email' => $email, 'password' => $password]))
        {
            return redirect('/profil')->with('success', 'Login Berhasil');
        }
        else
        {
            return redirect('/login1')->with('error', 'Email atau Password Salah');
        }
        
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/login1')->with('success', 'Logout Berhasil');
    }
}
