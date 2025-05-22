<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'customer'; // menggunakan 'customer' sesuai dengan ENUM di database
        $validatedData['name'] = explode('@', $request->email)[0]; // menggunakan bagian sebelum @ dari email sebagai nama

        User::create($validatedData);

        return redirect('/')->with('success', 'Registration successful! Please login.');
    }
} 