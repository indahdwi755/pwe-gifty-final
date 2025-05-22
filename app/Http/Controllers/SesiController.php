<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ],[
            'email.required'=>'Email Wajib Diisi',
            'email.email'=>'Format Email Tidak Valid',
            'password.required'=>'Password Wajib Diisi',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infologin)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else{
            return redirect()->route('login')
                ->withErrors('Email atau password yang dimasukkan tidak sesuai')
                ->withInput($request->except('password'));
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
