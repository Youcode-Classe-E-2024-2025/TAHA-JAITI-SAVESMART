<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function registerForm()
    {
        return view('auth.signup');
    }

    public function loginForm()
    {
        return view('auth.login');
    }


    //Register
    public function register(request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:255',
        ]);

        $is_head = $request->has('is_head');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_head' => $is_head,
        ]);

        Auth::login($user);

        return $is_head ? to_route('family.create') : to_route('home');
    }

    public function login(request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:8|max:255',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home')->with('status', 'Logged in successfully');
        }

        return to_route('auth.login.form')->with('status', 'Invalid password, please try again');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('auth.login.form');
    }
}
