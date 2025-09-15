<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalUserController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanUserController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\SettingUserController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect dari root (/) ke /home
Route::get('/', function () {
    return redirect('/home');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => view('admin.home-admin'));
});


// ========================== HOMEPAGE ==========================

// Halaman Home
Route::get('/home', fn() => view('home.index'))->name('home');

// Halaman Contact
Route::get('/home/contact', fn() => view('home.contact'))->name('contact');

// Halaman Informasi
Route::get('/home/informasi', fn() => view('home.informasi'))->name('informasi');

// ========== AUTH ==========

// FORM REGISTER (GET)
Route::get('/home/pendaftaran', function () {
    return view('home.pendaftaran');
})->name('register.form');

// PROSES REGISTER (POST)
Route::post('/home/pendaftaran', [AuthController::class, 'register'])->name('register.post');

// FORM LOGIN (GET)
Route::get('/home/login', function () {
    return view('home.login');
})->name('login.form');

// PROSES LOGIN (POST)
Route::post('/home/login', [AuthController::class, 'login'])->name('login.post');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ========== USER ==========
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', fn() => view('user.home-user'));

    Route::get('/user/home', [HomeController::class, 'index'])->name('user.home');

    Route::get('/pesan', [PesanUserController::class, 'index'])->name('user.pesan.index');
    Route::post('/pesan/read-all', [PesanUserController::class, 'markAllRead'])->name('user.pesan.readAll');
    Route::get('/pesan/read/{pesan}', [PesanUserController::class, 'markRead'])->name('user.pesan.read');
    // Dashboard User
    Route::get('/user/dashboard', [PendaftaranUserController::class, 'index'])
        ->name('user.dashboard');

    // Halaman Pendaftaran Peserta
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('/user/pendaftaran-user', [PendaftaranUserController::class, 'index'])->name('user.pendaftaran.index');
        Route::post('/user/pendaftaran-user', [PendaftaranUserController::class, 'store'])->name('user.pendaftaran.store');
        Route::put('/user/pendaftaran-user/update/{team}', [PendaftaranUserController::class, 'update'])
            ->name('user.pendaftaran.update');
    });


    Route::get('/user/jadwal-user', [JadwalUserController::class, 'index'])->name('user.jadwal');

    Route::get('/user/hasil-user', [HasilController::class, 'hasilPeserta'])->name('user.hasil');


    Route::get('/user/profile-user', [ProfileUserController::class, 'edit'])->name('user.profile.edit');
    Route::put('/user/profile-user', [ProfileUserController::class, 'update'])->name('user.profile.update');
    Route::post('/user/profile-user/upload-foto', [ProfileUserController::class, 'uploadFoto'])->name('user.profile.uploadFoto');


    Route::put(
        '/user/setting-user/password',
        [\App\Http\Controllers\SettingUserController::class, 'updatePassword']
    )->name('user.setting.updatePassword');

    // Pesan
    Route::get('/user/pesan', [UserController::class, 'pesanIndex'])->name('user.pesan.index');
    Route::get('/user/pesan/{pesan}', [UserController::class, 'pesanRead'])->name('user.pesan.read');
});

// TESS


// ========== ADMIN ==========
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Home Admin
    Route::get('/admin', fn() => view('admin.home-admin'));

    // Cek Pendaftaran
    Route::get('/admin/daftar-admin', [AdminController::class, 'index'])->name('admin.daftar');
    Route::get('/admin/detail-sekolah/{id}', [AdminController::class, 'detail'])->name('admin.detail');
    Route::post('/admin/verifikasi/{id}', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');

    // Pesan 
    Route::get('/admin/pesan-admin', [PesanController::class, 'index'])->name('admin.pesan.index');
    Route::post('/admin/pesan-admin', [PesanController::class, 'store'])->name('admin.pesan.store');
    Route::delete('/admin/pesan-admin/{pesan}', [PesanController::class, 'destroy'])->name('admin.pesan.destroy');
    Route::get('/admin/pesan-admin/{pesan}/edit', [PesanController::class, 'edit'])->name('admin.pesan.edit');
    Route::put('/admin/pesan-admin/{pesan}', [PesanController::class, 'update'])->name('admin.pesan.update');

    // Jadwal 
    Route::get('/admin/jadwal-admin', [JadwalController::class, 'index'])->name('admin.jadwal.index');
    Route::post('/admin/jadwal-admin', [JadwalController::class, 'store'])->name('admin.jadwal.store');
    Route::delete('/admin/jadwal-admin/{id}', [JadwalController::class, 'destroy'])->name('admin.jadwal.destroy');

    // Hasil
    Route::get('/admin/hasil-admin', [HasilController::class, 'index'])->name('admin.hasil-admin.index');
    Route::post('/admin/hasil-admin', [HasilController::class, 'store'])->name('admin.hasil-admin.store');
    Route::put('/admin/hasil-admin/{hasil}', [HasilController::class, 'update'])->name('admin.hasil-admin.update');
    Route::delete('/admin/hasil-admin/{hasil}', [HasilController::class, 'destroy'])->name('admin.hasil-admin.destroy');

    // Profile
    Route::get('/admin/profile-admin', fn() => view('admin.profile-admin'));

    // Setinng
    Route::get('/admin/setting-admin', fn() => view('admin.setting-admin'));

    // Laporan
    Route::get('/admin/laporan-admin', [LaporanController::class, 'index'])
        ->name('admin.laporan.index');
    Route::get('/admin/laporan-admin/export/pdf', [LaporanController::class, 'exportPdf'])
        ->name('admin.laporan.export.pdf');
    Route::get('/admin/laporan-admin/export/excel', [LaporanController::class, 'exportExcel'])
        ->name('admin.laporan.export.excel');
    Route::get('/admin/laporan-admin/detail/{team}', [LaporanController::class, 'detail'])
        ->name('admin.hasil-admin.detail');
    Route::get('/admin/laporan-admin/backup', [LaporanController::class, 'backup'])
        ->name('admin.laporan.backup');
    Route::get('/admin/laporan-admin/reset', [LaporanController::class, 'reset'])
        ->name('admin.laporan.reset');

    // Kelolal Home Page
    Route::get('/admin/kelola-homepage', fn() => view('admin.kelola-homepage'));
    // Route::get('/admin/detail-sekolah', fn() => view('admin.detail-sekolah'));
});
