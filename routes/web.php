<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/signup', 'registerForm')->name('auth.signup');
    Route::post('/signup', 'register')->name('auth.signuppost');
});


Route::controller(FamilyController::class)->group(function() {
    Route::get('/family/create', 'create')->name('family.create');
    Route::get('/family/code', 'code')->name('family.code');
});
