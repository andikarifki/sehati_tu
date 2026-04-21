<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController; // Pastikan import ini ada
use App\Models\Arsip;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'totalPegawai' => Pegawai::count(),
        'totalArsip' => Arsip::count(), // Tambahkan baris ini
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    // --- MANAJEMEN ARSIP DIGITAL ---
    // Rute Index (Halaman Utama & Pencarian)
    Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');

    // Rute Create (Form Upload)
    Route::get('/arsip/create', [ArsipController::class, 'create'])->name('arsip.create');

    // Rute Store (Proses Simpan ke Database & Storage)
    Route::post('/arsip', [ArsipController::class, 'store'])->name('arsip.store');
    Route::get('/arsip/{id}/edit', [ArsipController::class, 'edit'])->name('arsip.edit');
    Route::put('/arsip/{id}', [ArsipController::class, 'update'])->name('arsip.update'); // Gunakan PUT

    // Rute Destroy (Proses Hapus Data & File Fisik)
    // Gunakan {id} agar sesuai dengan parameter di ArsipController@destroy
    Route::delete('/arsip/{id}', [ArsipController::class, 'destroy'])->name('arsip.destroy');
});

require __DIR__.'/auth.php';
