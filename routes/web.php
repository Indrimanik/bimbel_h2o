<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PengajarController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // ======================
    // HALAMAN KELAS
    // ======================
    Route::get('/kelas', [KelasController::class, 'index']);

    // CREATE
    Route::post('/daftar-program', [KelasController::class, 'daftarProgram']);

    // SUKSES
    Route::get('/sukses/{id}', [KelasController::class, 'sukses']);

    // ======================
    // CETAK STRUK
    // ======================
    // PDF (SUDAH ADA)
    Route::get('/cetak-struk/{id}', [KelasController::class, 'cetakStruk'])->name('struk.pdf');

    // EXCEL (BARU)
    Route::get('/cetak-struk-excel/{id}', [KelasController::class, 'exportExcel'])->name('struk.excel');

    // ======================
    // RIWAYAT
    // ======================
    Route::get('/riwayat', [KelasController::class, 'riwayat']);

    // UPDATE
    Route::get('/edit/{id}', [KelasController::class, 'edit']);
    Route::put('/update/{id}', [KelasController::class, 'update']);

    // DELETE
    Route::delete('/hapus/{id}', [KelasController::class, 'hapus']);

    // ======================
    // PROFILE
    // ======================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // ======================
    // PENGAJAR
    // ======================
    Route::get('/pengajar', [PengajarController::class, 'index']);
});

require __DIR__.'/auth.php';