<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return redirect('/login');
});


// 🔥 TAMBAHAN PENTING (REDIRECT ROLE SETELAH LOGIN)
Route::get('/redirect-role', function () {

    if (auth()->user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/dashboard');
});


// =======================
// DASHBOARD SISWA
// =======================
Route::middleware(['auth', 'role:siswa'])->group(function () {

    Route::get('/dashboard', [SiswaController::class, 'index'])->name('dashboard');

    // ======================
    // HALAMAN KELAS
    // ======================
    Route::get('/kelas', [KelasController::class, 'index']);

    Route::post('/daftar-program', [KelasController::class, 'daftarProgram']);

    Route::get('/sukses/{id}', [KelasController::class, 'sukses']);

    // ======================
    // CETAK STRUK
    // ======================
    Route::get('/cetak-struk/{id}', [KelasController::class, 'cetakStruk'])->name('struk.pdf');

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


// =======================
// DASHBOARD ADMIN
// =======================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // ======================
    // KELOLA DATA SISWA
    // ======================
    Route::get('/admin/pendaftaran', [AdminController::class, 'pendaftaran']);

    // VERIFIKASI PEMBAYARAN
    Route::post('/admin/verifikasi/{id}', [AdminController::class, 'verifikasi']);

    // ======================
    // KELOLA KELAS
    // ======================
    Route::get('/admin/kelas', [AdminController::class, 'kelas']);
    Route::post('/admin/kelas/tambah', [AdminController::class, 'tambahKelas']);
    Route::put('/admin/kelas/update/{id}', [AdminController::class, 'updateKelas']);
    Route::delete('/admin/kelas/hapus/{id}', [AdminController::class, 'hapusKelas']);
});


// =======================
// AUTH
// =======================
require __DIR__.'/auth.php';