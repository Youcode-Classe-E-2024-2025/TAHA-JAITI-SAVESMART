<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinancialGoalController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
require __DIR__.'/category.php';
require __DIR__.'/transactions.php';


Route::get('/', static function () {
    return view('home');
})->name('home');

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/dashboard/transactions', 'transactions')->name('dashboard.transactions');
});

Route::resource('financial_goals', FinancialGoalController::class);


Route::controller(FamilyController::class)->group(function() {
    Route::post('/family/create', 'store')->name('family.store');
    Route::get('/family/create', 'create')->name('family.create');
    Route::get('/family/{family}/code', 'code')->name('family.code');
});


