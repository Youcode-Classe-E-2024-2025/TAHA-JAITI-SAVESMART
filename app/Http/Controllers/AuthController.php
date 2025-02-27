<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function loginForm(){
        return view('auth.login');
    }

    public function signupForm(){
        return view('auth.signup');
    }

    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email'=> 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create($data);

        // Auth::login($user);

        return to_route('auth.login')->with('success', 'Account created successfully');
    }
}
