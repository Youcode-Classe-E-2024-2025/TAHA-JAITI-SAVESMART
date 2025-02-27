<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'loginForm')->name('auth.login');
    Route::get('/signup', 'signupForm')->name('auth.signup');

    Route::post('/signup', 'register')->name('auth.signup.post');
    
});
