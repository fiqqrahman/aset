<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view();
});

Route::post('/logout', function () {
    return redirect('/');
})->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
});
