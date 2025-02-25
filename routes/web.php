<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', static function () {
    return view('home');
})->name('home');

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/dashboard/transactions', 'transactions')->name('dashboard.transactions');
});

require __DIR__.'/category.php';


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

Route::controller(TransactionController::class)->group(function() {

    Route::get('/transaction/create', 'create')->name('trans.create');
    Route::post('/transaction/create', 'store')->name('trans.store');
});
