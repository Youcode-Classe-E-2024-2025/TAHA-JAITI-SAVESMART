<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('home');
})->name('home');

Route::get('/dashboard', static fn() => view('dash.dashboard'));


Route::controller(AuthController::class)->group(function () {
    Route::get('/signup', 'registerForm')->name('auth.signup.form');
    Route::post('/signup', 'register')->name('auth.signup');

    Route::get('/login', 'loginForm')->name('auth.login.form');
    Route::post('/login', 'login')->name('auth.login');

    Route::post('/logout', 'logout')->name('auth.logout');
});


Route::controller(FamilyController::class)->group(function() {
    Route::post('/family/create', 'store')->name('family.store');
    Route::get('/family/create', 'create')->name('family.create');
    Route::get('/family/{family}/code', 'code')->name('family.code');
});
