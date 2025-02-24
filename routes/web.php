<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/signup', 'registerForm')->name('auth.signup');
    Route::post('/signup', 'register')->name('auth.signuppost');

    Route::get('/login', 'loginForm')->name('auth.login');
    Route::post('/login', 'login')->name('auth.loginpost');
});


Route::controller(FamilyController::class)->group(function() {
    Route::post('/family/create', 'store')->name('family.store');
    Route::get('/family/create', 'create')->name('family.create');
    Route::get('/family/{family}/code', 'code')->name('family.code');
});
