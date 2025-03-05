<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FinancialGoalController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function (){
    return view('home');
})->name('home');

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'loginForm')->name('auth.login');
    Route::get('/signup', 'signupForm')->name('auth.signup');

    Route::post('/signup', 'register')->name('auth.signup.post');
    Route::post('/login', 'login')->name('auth.login.post');
    Route::post('/logout','logout')->name('auth.logout');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::controller(FamilyController::class)->group(function(){
    Route::get('/family','index')->name('family.index');
    Route::post('/family/create','store')->name('family.create');
    Route::post('/family/join', 'join')->name('family.join');
    Route::delete('/family/destroy', 'destroy')->name('family.destroy');
    Route::post('/family/leave', 'leave')->name('family.leave');
    Route::delete('/family/remove/{user}', 'remove')->name('family.remove');
});

Route::resource('transaction', TransactionController::class);
Route::resource('category', CategoryController::class);
Route::resource('goal', FinancialGoalController::class);
Route::controller(FinancialGoalController::class)->group(function(){
    Route::get('/goal/{goal}/mark','')->name('goal.markAsDone');
    Route::post('/goal/{goal}/deposit','deposit')->name('goal.deposit');
});