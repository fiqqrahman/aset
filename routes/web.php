<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_MasterSekolah;
use App\Http\Controllers\Admin\AsetSekolahController;

// Route::middleware(['auth'])->group(function () {
//     // Secure Endpoint untuk Leaflet Map
//     Route::get('/admin/api/map-sekolah', [AsetSekolahController::class, 'getMapData'])
//         ->name('admin.api.map-sekolah');
// });

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
    Route::get('/master-unit/sync-stream', [C_MasterSekolah::class, 'syncStream'])->name('master-unit.sync-stream');

    Route::get('/api/map-sekolah', [C_MasterSekolah::class, 'getMapData'])
        ->name('api.map-sekolah');
});
