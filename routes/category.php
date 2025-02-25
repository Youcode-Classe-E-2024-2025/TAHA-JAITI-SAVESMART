<?php

use App\Http\Controllers\CategoryController;

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/create', 'create')->name('category.create');
    Route::post('/category/create', 'store')->name('category.store');
});
