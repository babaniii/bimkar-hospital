<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dokter\JadwalPeriksaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    Route::prefix('jadwal-periksa')->group(function () {
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa.index');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store');
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update');
    });

    Route::prefix('obat')->group(function () {
        Route::get('/', [\App\Http\Controllers\ObatController::class, 'index'])->name('dokter.obat.index');
        Route::post('/', [\App\Http\Controllers\ObatController::class, 'store'])->name('dokter.obat.store');
        Route::put('/{obat}', [\App\Http\Controllers\ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{obat}', [\App\Http\Controllers\ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });
});

require __DIR__.'/auth.php';
