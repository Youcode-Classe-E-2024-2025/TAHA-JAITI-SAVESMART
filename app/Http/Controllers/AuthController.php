<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function registerForm(){
        return view('auth.signup');
    }


    //Register
    public function register(request $request){

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

        if ($is_head) {
            return to_route()
        }

    }
}
