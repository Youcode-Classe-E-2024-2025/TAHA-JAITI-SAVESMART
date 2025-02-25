<?php

use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::get('/signup', 'registerForm')->name('auth.signup.form');
    Route::post('/signup', 'register')->name('auth.signup');

    Route::get('/login', 'loginForm')->name('auth.login.form');
    Route::post('/login', 'login')->name('auth.login');

    Route::post('/logout', 'logout')->name('auth.logout');
});
