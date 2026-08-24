<?php

use App\Http\Controllers\C_MasterSekolah;
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

    Route::get('/aset-sekolah', [C_MasterSekolah::class, 'index'])->name('aset-sekolah');
    Route::post('/aset-sekolah/snapshot', [C_MasterSekolah::class, 'snapshot'])->name('aset-sekolah.snapshot');

    Route::get('/master-unit', [C_MasterSekolah::class, 'masterUnit'])->name('master-unit');
    Route::post('/master-unit/sync', [C_MasterSekolah::class, 'syncApi'])->name('master-unit.sync');
});
