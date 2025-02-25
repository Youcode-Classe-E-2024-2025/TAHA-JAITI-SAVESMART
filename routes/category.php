<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/create', 'create')->name('category.create');
    Route::post('/category/create', 'store')->name('category.store');
});
