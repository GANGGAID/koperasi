<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'pegawai') {
            return redirect()->route('pegawai.dashboard');
        } else {
            return redirect()->route('anggota.dashboard');
        }
    })->name('dashboard');
});


// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/anggota', [AdminController::class, 'anggota'])->name('admin.anggota.index');
    // Route::get('/admin/anggota', [AdminController::class, 'create'])->name('admin.anggota.create');
    Route::get('/admin/simpan', [AdminController::class, 'simpan'])->name('admin.simpan.index');
    Route::get('/admin/pinjam', [AdminController::class, 'pinjam'])->name('admin.pinjam.index');
    Route::get('/admin/angsuran', [AdminController::class, 'angsuran'])->name('admin.angsuran.index');
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan.index');
    Route::get('/admin/master-data', [AdminController::class, 'masterData'])->name('master.index');
    Route::get('/register', function () { return view('auth.register');})->name('register');
});

// Pegawai
Route::middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('/pegawai/dashboard', [PegawaiController::class, 'index'])->name('pegawai.dashboard');
    Route::get('/pegawai/anggota', [PegawaiController::class, 'anggota'])->name('anggota.index');
    Route::get('/pegawai/simpan', [PegawaiController::class, 'simpan'])->name('simpan.index');
    Route::get('/pegawai/pinjam', [PegawaiController::class, 'pinjam'])->name('pinjam.index');
    Route::get('/pegawai/angsuran', [PegawaiController::class, 'angsuran'])->name('angsuran.index');
    Route::get('/pegawai/laporan', [PegawaiController::class, 'laporan'])->name('laporan.index');
});

// Anggota
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/anggota/dashboard', [AnggotaController::class, 'index'])->name('anggota.dashboard');
    Route::get('/anggota/transaksi', [AnggotaController::class, 'transaksi'])->name('anggota.transaksi');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
