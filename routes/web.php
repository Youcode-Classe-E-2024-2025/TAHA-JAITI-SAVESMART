<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'loginForm')->name('auth.login');
    Route::get('/signup', 'signupForm')->name('auth.signup');

    Route::post('/signup', 'register')->name('auth.signup.post');
    Route::post('/login', 'login')->name('auth.login.post');
    Route::get('/logout','logout')->name('auth.logout');
});

Route::get('/dashboard', function (){
    return view('index');
})->name('dashboard');


Route::controller(FamilyController::class)->group(function(){
    Route::get('/family','index')->name('family.index');
    Route::post('/family/create','store')->name('family.create');
    Route::post('/family/join', 'join')->name('family.join');
    Route::post('/family/destroy', 'destroy')->name('family.destroy');
    Route::post('/family/leave', 'leave')->name('family.leave');
    Route::post('/family/remove/{user}', 'remove')->name('family.remove');
});
