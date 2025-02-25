<?php

use App\Http\Controllers\TransactionController;

Route::controller(TransactionController::class)->group(function() {

    Route::get('/transaction/create', 'create')->name('trans.create');
    Route::post('/transaction/create', 'store')->name('trans.store');
    Route::delete('/transaction/{transaction}', 'destroy')->name('trans.destroy');
});
