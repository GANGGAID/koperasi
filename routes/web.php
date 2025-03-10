<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimpananController;
use App\Models\pinjam;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::middleware(['auth', 'role:admin,pegawai'])->prefix('share/admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //Anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('share.anggota.index');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('share.anggota.create');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('share.anggota.store');
    Route::get('/anggota/{anggota}/edit', [AnggotaController::class, 'edit'])->name('share.anggota.edit');
    Route::put('/anggota/{anggota}', [AnggotaController::class, 'update'])->name('share.anggota.update');
    Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy'])->name('share.anggota.destroy');
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('share.anggota.index');
    Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('auth.register');

    // Route::get('/anggota/edit', [AnggotaController::class, 'create'])->name('share.anggota.edit');
    //Simpanan
    Route::get('/simpan', [SimpananController::class, 'index'])->name('share.simpan.index');
    Route::get('/simpan/create', [SimpananController::class, 'create'])->name('share.simpan.create');
    Route::post('/simpan/store', [SimpananController::class, 'store'])->name('share.simpan.store');
    Route::get('/simpan/{id}/edit', [SimpananController::class, 'edit'])->name('share.simpan.edit');
    Route::put('/simpan/{id}', [SimpananController::class, 'update'])->name('share.simpan.update');
    Route::get('/simpan/{id}/penarikan', [SimpananController::class, 'tarik'])->name('share.simpan.tarik');
    Route::post('/simpan/{id}/proses-penarikan', [SimpananController::class, 'prosesPenarikan'])->name('simpanan.prosesPenarikan');
    Route::get('/simpan/{id}/riwayat', [SimpananController::class, 'riwayat'])->name('share.simpan.riwayat');
    Route::delete('/simpan/{id}', [SimpananController::class, 'destroy'])->name('share.simpan.destroy');
    //Pinjaman
    Route::get('/pinjam', [PinjamanController::class, 'index'])->name('share.pinjam.index');
    Route::get('/pinjam/create', [PinjamanController::class, 'create'])->name('share.pinjam.create');
    Route::post('/pinjam/store', [PinjamanController::class, 'store'])->name('share.pinjam.store');
    Route::get('/pinjam/{id}/edit', [PinjamanController::class, 'edit'])->name('share.pinjam.edit');
    Route::put('/share/admin/pinjam/{id}', [PinjamanController::class, 'update'])->name('share.pinjam.update');
    Route::get('/pinjam/simulasi', [PinjamanController::class, 'simulasi'])->name('share.pinjam.simulasi');
    Route::get('/pinjam/{id}/bayar', [PinjamanController::class, 'bayar'])->name('share.pinjam.bayar');
    Route::post('/pinjaman/{id}/bayar', [PinjamanController::class, 'storeBayar'])->name('share.pinjam.bayar.store');
    Route::get('/pinjaman/{id}/riwayat', [PinjamanController::class, 'riwayat'])->name('share.pinjam.riwayat');
    Route::delete('/share/pinjam/{id}', [PinjamanController::class, 'destroy'])->name('share.pinjam.destroy');

    //Angsuran
    Route::get('/angsuran', [AngsuranController::class, 'index'])->name('share.angsuran.index');
    Route::get('/angsuran/create', [AngsuranController::class, 'create'])->name('share.angsuran.create');
    Route::post('/angsuran/store', [AngsuranController::class, 'store'])->name('share.angsuran.store');
    //Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('share.laporan.index');
});

Route::middleware(['auth', 'role:pegawai'])->prefix('share/pegawai')->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'index'])->name('pegawai.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/master-data', [AdminController::class, 'masterData'])->name('admin.master-data.index');
    Route::get('/register', function () { return view('auth.register');})->name('register');
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
