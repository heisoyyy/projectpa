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
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\SettingUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\HomepageController;
// Homepage
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\FeaturedController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\JuaraController;

// Informasi
use App\Http\Controllers\Informasi\InformasiController;
use App\Http\Controllers\Admin\KelolaInformasiController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\SettingPendaftaranController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect dari root (/) ke /home
Route::get('/', function () {
    return redirect('/home');
});

// ========================== HOMEPAGE ==========================

// Halaman Home
// Route::get('/home', fn() => view('home.index'))->name('home');
Route::get('/home', [HomepageController::class, 'index'])->name('home');

// Halaman Contact
Route::get('/home/contact', [KontakController::class, 'contact'])->name('home.contact');

// Informasi
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/home/pendaftaran', function () {
    return view('home.pendaftaran');
})->name('register.form');

// PROSES REGISTER (POST)
Route::post('/home/pendaftaran', [AuthController::class, 'register'])->name('register.post');
Route::get('/home/pendaftaran', [AuthController::class, 'showForm'])->name('register.form');

// ========== AUTH ==========

// FORM REGISTER (GET)
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

    Route::get('/user', [DashboardUserController::class, 'index'])->name('user.home');

    Route::get('/user/home', [HomeController::class, 'index'])->name('user.home');

    Route::get('/user/cek-dokumen', [App\Http\Controllers\UserController::class, 'cekDokumenStatus'])
        ->name('user.cek-dokumen');
    // Pesan
    Route::get('/user/pesan', [UserController::class, 'pesanIndex'])->name('user.pesan.index');
    Route::get('/user/pesan/{pesan}', [UserController::class, 'pesanRead'])->name('user.pesan.read');

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

    Route::get('/user/setting-user', [SettingUserController::class, 'index'])->name('user.setting');
    // Route::put('/user/setting-user/password',[SettingUserController::class, 'updatePassword'])->name('user.setting.updatePassword');
});

// ========== ADMIN ==========
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin', fn() => view('admin.home-admin'));
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('admin.home');

    // Cek Pendaftaran
    Route::get('/admin/daftar-admin', [AdminController::class, 'index'])->name('admin.daftar');
    Route::get('/admin/detail-sekolah/{id}', [AdminController::class, 'detail'])->name('admin.detail');
    Route::post('/admin/verifikasi/{id}', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::delete('/admin/hapus-sekolah/{id}', [AdminController::class, 'hapusSekolah']);
    // Toggle status pendaftaran
    Route::post('/pendaftaran/toggle', [DashboardAdminController::class, 'togglePendaftaran'])->name('admin.pendaftaran.toggle');

    // Pesan 
    Route::get('/admin/pesan-admin', [PesanController::class, 'index'])->name('admin.pesan.index');
    Route::post('/admin/pesan-admin', [PesanController::class, 'store'])->name('admin.pesan.store');
    Route::delete('/admin/pesan-admin/{pesan}', [PesanController::class, 'destroy'])->name('admin.pesan.destroy');
    Route::get('/admin/pesan-admin/{pesan}/edit', [PesanController::class, 'edit'])->name('admin.pesan.edit');
    Route::put('/admin/pesan-admin/{pesan}', [PesanController::class, 'update'])->name('admin.pesan.update');

    // Jadwal 
    Route::get('/admin/jadwal-admin', [JadwalController::class, 'index'])->name('admin.jadwal.index');
    Route::post('/admin/jadwal-admin', [JadwalController::class, 'store'])->name('admin.jadwal.store');
    Route::put('/admin/jadwal-admin/{id}', [JadwalController::class, 'update'])->name('admin.jadwal.update');
    Route::delete('/admin/jadwal-admin/{id}', [JadwalController::class, 'destroy'])->name('admin.jadwal.destroy');

    // Hasil
    Route::get('/admin/hasil-admin', [HasilController::class, 'index'])->name('admin.hasil-admin.index');
    Route::post('/admin/hasil-admin', [HasilController::class, 'store'])->name('admin.hasil-admin.store');
    Route::put('/admin/hasil-admin/{hasil}', [HasilController::class, 'update'])->name('admin.hasil-admin.update');
    Route::delete('/admin/hasil-admin/{hasil}', [HasilController::class, 'destroy'])->name('admin.hasil-admin.destroy');

    // Profile
    Route::get('/admin/profile-admin', [ProfileAdminController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile-admin', [ProfileAdminController::class, 'update'])->name('admin.profile.update');

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

    // // Kelolal Home Page
    // Route::get('/admin/kelola-homepage', fn() => view('admin.kelola-homepage'));
    // // Route::get('/admin/detail-sekolah', fn() => view('admin.detail-sekolah'));



});

// // Kelola Homepage
// Route::get('/admin/homepage', [HomepageController::class, 'index'])->name('admin.homepage');

// // Banner
// Route::post('banner', [BannerController::class, 'store'])->name('banner.store');
// Route::put('banner/{banner}', [BannerController::class, 'update'])->name('banner.update');
// Route::delete('banner/{banner}', [BannerController::class, 'destroy'])->name('banner.destroy');

// // Featured
// Route::put('featured/{id}', [FeaturedController::class, 'update'])->name('featured.update');
// Route::post('accordion', [FeaturedController::class, 'storeAccordion'])->name('accordion.store');
// Route::put('accordion/{accordion}', [FeaturedController::class, 'updateAccordion'])->name('accordion.update');
// Route::delete('accordion/{accordion}', [FeaturedController::class, 'destroyAccordion'])->name('accordion.destroy');

// // Video
// Route::post('video', [VideoController::class, 'store'])->name('video.store');
// Route::put('video/{video}', [VideoController::class, 'update'])->name('video.update');
// Route::delete('video/{video}', [VideoController::class, 'destroy'])->name('video.destroy');

// // Statistik
// Route::put('statistik/judul', [StatistikController::class, 'updateJudul'])->name('statistik.judul.update');
// Route::post('statistik', [StatistikController::class, 'store'])->name('statistik.store');
// Route::put('statistik/{statistik}', [StatistikController::class, 'update'])->name('statistik.update');
// Route::delete('statistik/{statistik}', [StatistikController::class, 'destroy'])->name('statistik.destroy');

// // Juara
// Route::post('juara', [JuaraController::class, 'store'])->name('juara.store');
// Route::put('juara/{juara}', [JuaraController::class, 'update'])->name('juara.update');
// Route::delete('juara/{juara}', [JuaraController::class, 'destroy'])->name('juara.destroy');


// Homepage Home
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Homepage
    Route::get('homepage', [App\Http\Controllers\Admin\HomepageController::class, 'index'])->name('admin.homepage');

    // Banner
    Route::post('banner', [BannerController::class, 'store'])->name('admin.banner.store');
    Route::put('banner/{banner}', [BannerController::class, 'update'])->name('admin.banner.update');
    Route::delete('banner/{banner}', [BannerController::class, 'destroy'])->name('admin.banner.destroy');

    // Featured & Accordion
    Route::put('featured/{id}', [FeaturedController::class, 'update'])->name('admin.featured.update');

    Route::post('accordion', [FeaturedController::class, 'storeAccordion'])->name('admin.accordion.store');
    Route::put('accordion/{accordion}', [FeaturedController::class, 'updateAccordion'])->name('admin.accordion.update');
    Route::delete('accordion/{accordion}', [FeaturedController::class, 'destroyAccordion'])->name('admin.accordion.destroy');

    // Video
    Route::post('video', [VideoController::class, 'store'])->name('admin.video.store');
    Route::put('video/{video}', [VideoController::class, 'update'])->name('admin.video.update');
    Route::delete('video/{video}', [VideoController::class, 'destroy'])->name('admin.video.destroy');

    // Statistik
    Route::put('statistik/judul', [StatistikController::class, 'updateJudul'])->name('admin.statistik.judul.update');
    Route::post('statistik', [StatistikController::class, 'store'])->name('admin.statistik.store');
    Route::put('statistik/{statistik}', [StatistikController::class, 'update'])->name('admin.statistik.update');
    Route::delete('statistik/{statistik}', [StatistikController::class, 'destroy'])->name('admin.statistik.destroy');

    // Juara
    Route::post('juara', [JuaraController::class, 'store'])->name('admin.juara.store');
    Route::put('juara/{juara}', [JuaraController::class, 'update'])->name('admin.juara.update');
    Route::delete('juara/{juara}', [JuaraController::class, 'destroy'])->name('admin.juara.destroy');

    // Informasi
    // Kelola Informasi
    Route::get('kelola-informasi', [KelolaInformasiController::class, 'index'])->name('admin.kelola-informasi');

    Route::post('kelola-informasi/hero', [KelolaInformasiController::class, 'updateHero'])->name('admin.kelola-informasi.hero');

    Route::post('kelola-informasi/biodata/{id}', [KelolaInformasiController::class, 'updateBiodata'])->name('admin.kelola-informasi.biodata');

    Route::post('kelola-informasi/dokumen', [KelolaInformasiController::class, 'storeDokumen'])->name('admin.kelola-informasi.dokumen.store');
    Route::put('kelola-informasi/dokumen/{id}', [KelolaInformasiController::class, 'updateDokumen'])->name('admin.kelola-informasi.dokumen.update');
    Route::delete('kelola-informasi/dokumen/{id}', [KelolaInformasiController::class, 'deleteDokumen'])->name('admin.kelola-informasi.dokumen.delete');

    Route::post('kelola-informasi/history', [KelolaInformasiController::class, 'storeHistory'])->name('admin.kelola-informasi.history.store');
    Route::put('kelola-informasi/history/{id}', [KelolaInformasiController::class, 'updateHistory'])->name('admin.kelola-informasi.history.update');
    Route::delete('kelola-informasi/history/{id}', [KelolaInformasiController::class, 'deleteHistory'])->name('admin.kelola-informasi.history.delete');
});

// Homepage Informasi
// Route::get('/admin/kelola-informasi', fn() => view('admin.kelola-informasi'));



// Admin
// Route::get('/admin/kelola-informasi', [KelolaInformasiController::class, 'index'])->name('admin.kelola-informasi.index');
