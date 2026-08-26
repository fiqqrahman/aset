<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\C_MasterSekolah;
use App\Http\Controllers\AsetSekolahController;


// Redirect root ke login atau dashboard
Route::get('/', function () {
    return Auth::check() ? redirect()->route('admin.dashboard') : redirect()->route('login');
});

// --- ROUTE GUEST ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// --- ROUTE AUTHENTICATED ---
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return view('pages.dashboard');
        })->name('dashboard');

        Route::get('/aset-sekolah', [C_MasterSekolah::class, 'index'])->name('aset-sekolah');
        Route::post('/aset-sekolah/snapshot', [C_MasterSekolah::class, 'snapshot'])->name('aset-sekolah.snapshot');

        // Nama route otomatis menjadi admin.aset-sekolah.update karena grup prefix 'admin.'
        Route::put('/aset-sekolah/{id}', [AsetSekolahController::class, 'update'])->name('aset-sekolah.update');

        Route::get('/master-unit', [C_MasterSekolah::class, 'masterUnit'])->name('master-unit');
        Route::get('/master-unit/sync-stream', [C_MasterSekolah::class, 'syncStream'])->name('master-unit.sync-stream');

        Route::get('/api/map-sekolah', [C_MasterSekolah::class, 'getMapData'])->name('api.map-sekolah');
    });
});