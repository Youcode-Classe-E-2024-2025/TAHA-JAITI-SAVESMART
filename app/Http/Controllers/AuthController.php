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

        $is_head = $request->has('is_head') ? true : false;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_head' => $is_head,
        ]);

        Auth::login($user);

        if ($is_head) {
            return to_route('family.create');
        }

        return to_route('auth.signup');
    }

    public function login(request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:8|max:255',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('auth.login')->with('status', 'Logged in successfully');
        }

        return back()->with('status', 'Invalid login details');
    }
}
