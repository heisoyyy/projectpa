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
use App\Http\Controllers\Admin\UserVerificationController;
use App\Http\Controllers\Admin\SettingAdminController;

// Informasi
use App\Http\Controllers\Informasi\InformasiController;
use App\Http\Controllers\Admin\KelolaInformasiController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\SettingPendaftaranController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Juri
use App\Http\Controllers\Juri\JuriController;
use App\Http\Controllers\juri\PesertaJuriController;
use App\Http\Controllers\juri\TimJuriController;
use App\Http\Controllers\juri\JadwalJuriController;
use App\Http\Controllers\juri\NilaiJuriController;
use App\Http\Controllers\juri\SettingJuriController;
use App\Http\Controllers\juri\ProfileJuriController;

// OTP Resend
Route::get('/otp/resend', function () {
    return view('auth.resend_otp');
})->name('otp.resend.form');

Route::post('/otp/resend', [AuthController::class, 'resendOtp'])->name('otp.resend');

// Lupa Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    */

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
// Redirect dari root (/) ke /home
Route::get('/', function () {
    return redirect('/home');
});

// ========================== HOMEPAGE ==========================

// Halaman Home
// Route::get('/home', fn() => view('home.index'))->name('home');
Route::get('/home', [HomepageController::class, 'index'])->name('home');

// Halaman Contact
Route::get('/home/contact', [ContactController::class, 'contact'])->name('home.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

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


// ========== USER ROUTES ==========
Route::middleware(['ensure.login', 'role:user'])->group(function () {

    Route::get('/user', [DashboardUserController::class, 'index'])->name('user.home');

    Route::get('/user/home', [HomeController::class, 'index'])->name('user.home');

    Route::get('/user/cek-dokumen', [UserController::class, 'cekDokumenStatus'])
        ->name('user.cek-dokumen');

    // ========== PESAN ROUTES (URUTAN PENTING!) ==========
    // PENTING: Route mark-all-read HARUS DI ATAS route {pesan}
    // Karena Laravel route matching dari atas ke bawah
    Route::post('/user/pesan/mark-all-read', [UserController::class, 'markAllAsRead'])
        ->name('user.pesan.markAllRead');

    // Route list pesan
    Route::get('/user/pesan', [UserController::class, 'pesanIndex'])
        ->name('user.pesan.index');

    // Route read pesan (pakai {pesan} bukan {id} untuk consistency)
    Route::get('/user/pesan/{pesan}', [UserController::class, 'pesanRead'])
        ->name('user.pesan.read');

    // Dashboard User
    Route::get('/user/dashboard', [PendaftaranUserController::class, 'index'])
        ->name('user.dashboard');

    // Notifikasi
    Route::get('/user/notifikasi', [NotifikasiController::class, 'index'])
        ->name('user.notifikasi.index');
    Route::post('/user/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])
        ->name('user.notifikasi.read');
    Route::delete('/user/notifikasi/{id}', [NotifikasiController::class, 'destroy'])
        ->name('user.notifikasi.destroy');

    // Halaman Pendaftaran Peserta
    // ========== PENDAFTARAN MULTI TIM ==========
    // Halaman Pendaftaran (List semua tim)
    Route::get('/user/pendaftaran-user', [PendaftaranUserController::class, 'index'])
        ->name('user.pendaftaran.index');
    // Tambah Tim Baru
    Route::post('/user/pendaftaran/team', [PendaftaranUserController::class, 'storeTeam'])
        ->name('user.pendaftaran.store.team');
    // Tambah/Update Anggota Tim (Peserta & Pelatih)
    Route::post('/user/pendaftaran/{teamId}/members', [PendaftaranUserController::class, 'storeMembers'])
        ->name('user.pendaftaran.store.members');
    Route::put('/user/pendaftaran/{teamId}/members', [PendaftaranUserController::class, 'updateMembers'])
        ->name('user.pendaftaran.update.members');
    // Hapus Tim
    Route::delete('/user/pendaftaran/team/{teamId}', [PendaftaranUserController::class, 'deleteTeam'])
        ->name('user.pendaftaran.delete.team');
    // Hapus Member (Peserta/Pelatih)
    Route::delete('/user/pendaftaran/member/{memberId}', [PendaftaranUserController::class, 'deleteMember'])
        ->name('user.pendaftaran.delete.member');

    // Halaman Jadwal Peserta
    Route::get('/user/jadwal-user', [JadwalUserController::class, 'index'])
        ->name('user.jadwal');

    Route::get('/user/hasil-user', [HasilController::class, 'hasilPeserta'])
        ->name('user.hasil');

    Route::get('/user/profile-user', [ProfileUserController::class, 'edit'])
        ->name('user.profile.edit');
    Route::put('/user/profile-user', [ProfileUserController::class, 'update'])
        ->name('user.profile.update');
    Route::post('/user/profile-user/upload-foto', [ProfileUserController::class, 'uploadFoto'])
        ->name('user.profile.uploadFoto');

    // 📝 Halaman Setting User (ganti password)
    Route::get('/user/setting-user', [SettingUserController::class, 'index'])
        ->name('user.setting');

    // 🔑 Proses update password
    Route::put('/user/setting/update-password', [SettingUserController::class, 'updatePassword'])
        ->name('user.setting.updatePassword');
});

// ========== ADMIN ==========
Route::middleware(['ensure.login', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('admin.home');

    // Cek Pendaftaran
    Route::get('/admin/daftar-admin', [AdminController::class, 'index'])->name('admin.daftar');
    Route::get('/admin/detail-sekolah/{id}', [AdminController::class, 'detail'])->name('admin.detail');
    Route::post('/admin/verifikasi/{id}', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::put('/admin/team/update/{id}', [AdminController::class, 'updateTim'])->name('admin.updateTim');


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
    Route::post('/hasil/{id}/publish', [HasilController::class, 'publish'])->name('hasil.publish');
    Route::post('/hasil/{id}/unpublish', [HasilController::class, 'unpublish'])->name('hasil.unpublish');
    Route::post('/admin/hasil/publish-all', [HasilController::class, 'publishAll'])->name('admin.hasil.publishAll');
    Route::post('/admin/hasil/unpublish-all', [HasilController::class, 'unpublishAll'])->name('admin.hasil.unpublishAll');


    // Profile
    Route::get('/admin/profile-admin', [ProfileAdminController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile-admin', [ProfileAdminController::class, 'update'])->name('admin.profile.update');

    // Setinng
    Route::get('/setting-admin', [SettingAdminController::class, 'index'])->name('admin.setting');
    Route::post('/setting-admin/password', [SettingAdminController::class, 'updatePassword'])->name('admin.password.update');

    // Halaman daftar admin/juri
    Route::get('/admin/manage-user', [AdminController::class, 'manageUser'])->name('admin.manageUser');
    // Tambah admin/juri
    Route::post('/admin/manage-user/store', [AdminController::class, 'storeUser'])->name('admin.storeUser');
    // Update admin/juri
    Route::put('/admin/manage-user/update/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    // Hapus admin/juri
    Route::delete('/admin/manage-user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');



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
});

// ========== ADMIN HOMEPAGE==========
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Homepage
    Route::get('homepage', [HomepageController::class, 'index'])->name('admin.homepage');

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
    Route::get('kelola-informasi', [KelolaInformasiController::class, 'index'])->name('admin.kelola-informasi');
    Route::post('kelola-informasi/hero', [KelolaInformasiController::class, 'updateHero'])->name('admin.kelola-informasi.hero');
    Route::post('kelola-informasi/biodata/{id}', [KelolaInformasiController::class, 'updateBiodata'])->name('admin.kelola-informasi.biodata');
    Route::post('kelola-informasi/dokumen', [KelolaInformasiController::class, 'storeDokumen'])->name('admin.kelola-informasi.dokumen.store');
    Route::put('kelola-informasi/dokumen/{id}', [KelolaInformasiController::class, 'updateDokumen'])->name('admin.kelola-informasi.dokumen.update');
    Route::delete('kelola-informasi/dokumen/{id}', [KelolaInformasiController::class, 'deleteDokumen'])->name('admin.kelola-informasi.dokumen.delete');
    Route::post('kelola-informasi/history', [KelolaInformasiController::class, 'storeHistory'])->name('admin.kelola-informasi.history.store');
    Route::put('kelola-informasi/history/{id}', [KelolaInformasiController::class, 'updateHistory'])->name('admin.kelola-informasi.history.update');
    Route::delete('kelola-informasi/history/{id}', [KelolaInformasiController::class, 'deleteHistory'])->name('admin.kelola-informasi.history.delete');

    Route::get('/admin/verifikasi-user', [UserVerificationController::class, 'index'])->name('admin.verifikasi.index');
    Route::post('/admin/verifikasi-user/{id}', [UserVerificationController::class, 'verifyUser'])->name('admin.verifikasi.verify');
    Route::delete('/admin/verifikasi/{id}/delete', [UserVerificationController::class, 'destroy'])
        ->name('admin.verifikasi.delete');
    Route::put('/admin/verifikasi/{id}/update', [UserVerificationController::class, 'update'])
        ->name('admin.verifikasi.update');
    Route::put('/admin/verifikasi/{id}/password', [UserVerificationController::class, 'updatePassword'])
        ->name('admin.verifikasi.updatePassword');
});

Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('verify.form');
Route::post('/verify', [AuthController::class, 'verifyOtp'])->name('verify.otp');

// ========== Juri ==========

Route::middleware(['role:juri'])->prefix('juri')->group(function () {

    Route::get('/', [JuriController::class, 'index']);

    // hanya bisa lihat (READ only)
    Route::get('/peserta-sekolah', [PesertaJuriController::class, 'index']);
    Route::get('/tim-sekolah', [TimJuriController::class, 'index']);
    Route::get('/detail-sekolah/{id}', [TimJuriController::class, 'detail'])->name('juri.detail');
    Route::get('/jadwal-juri', [JadwalJuriController::class, 'index']);

    // CRUD penuh
    Route::get('/hasil-juri', [NilaiJuriController::class, 'index'])->name('juri.hasil-juri.index');
    Route::post('/nilai', [NilaiJuriController::class, 'store'])->name('juri.hasil-juri.store');
    Route::put('/nilai/{hasil}', [NilaiJuriController::class, 'update'])->name('juri.hasil-juri.update');
    Route::delete('/nilai/{hasil}', [NilaiJuriController::class, 'destroy'])->name('juri.hasil-juri.destroy');

    // Profile
    Route::get('/profile-juri', [ProfileJuriController::class, 'edit'])->name('juri.profile.edit');
    Route::put('/profile-juri', [ProfileJuriController::class, 'update'])->name('juri.profile.update');

    // Setinng
    Route::get('/setting-juri', [SettingJuriController::class, 'index'])->name('juri.setting');
    Route::post('/setting-juri/password', [SettingJuriController::class, 'updatePassword'])->name('juri.password.update');
});
