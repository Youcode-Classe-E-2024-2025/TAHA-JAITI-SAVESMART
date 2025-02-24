<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/signup', 'registerForm')->name('auth.signup');
    Route::post('/signup', 'register')->name('auth.signuppost');
});
