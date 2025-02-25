<?php

use App\Http\Controllers\TransactionController;

Route::controller(TransactionController::class)->group(function() {

    Route::get('/transaction/create', 'create')->name('trans.create');
    Route::post('/transaction/create', 'store')->name('trans.store');

    Route::get('/transaction/{transaction}', 'edit')->name('trans.edit');
    Route::put('/transaction/{transaction}', 'update')->name('trans.update');

    Route::delete('/transaction/{transaction}', 'destroy')->name('trans.destroy');
});
