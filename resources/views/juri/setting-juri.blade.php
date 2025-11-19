<!-- views/juri/setting-juri.blade.php -->
@extends('juri.komponen.komponen')

@section('title', 'Setting Juri')

@section('content')

<div class="container-fluid mb-4 mt-4">

    {{-- 🔔 Flash Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
            <div>
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
            <div>
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Page Header --}}
    <div class="card border-0 shadow-sm mb-4 bg-dark text-white">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">Pengaturan Akun & Sistem</h3>
                            <p class="mb-0 opacity-75">Kelola keamanan dan preferensi akun Anda</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <small class="d-flex align-items-center justify-content-md-end">
                        <i class="bi bi-clock me-2"></i>
                        {{ now()->format('d M Y, H:i') }} WIB
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- 🔑 Ubah Password --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-warning bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 fw-bold">Keamanan Password</h5>
                        </div>
                        <span class="badge bg-warning">Penting</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-warning border-0 d-flex align-items-start mb-4">
                        <i class="bi bi-info-circle-fill me-2 mt-1"></i>
                        <small>Gunakan password yang kuat dengan kombinasi huruf, angka, dan simbol</small>
                    </div>

                    <form action="{{ route('juri.password.update') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-lock text-muted me-1"></i> Password Lama
                            </label>
                            <input type="password"
                                name="password_lama"
                                class="form-control form-control-lg @error('password_lama') is-invalid @enderror"
                                placeholder="Masukkan password lama"
                                required>
                            @error('password_lama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-key text-muted me-1"></i> Password Baru
                            </label>
                            <input type="password"
                                name="password_baru"
                                class="form-control form-control-lg @error('password_baru') is-invalid @enderror"
                                placeholder="Masukkan password baru"
                                required>
                            @error('password_baru')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-flex align-items-center mt-2">
                                <i class="bi bi-shield-check me-1"></i> Minimal 8 karakter
                            </small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-check-circle text-muted me-1"></i> Konfirmasi Password Baru
                            </label>
                            <input type="password"
                                name="password_baru_confirmation"
                                class="form-control form-control-lg"
                                placeholder="Ulangi password baru"
                                required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg shadow-sm">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 📊 Informasi Akun --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-info bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold">Informasi Akun</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <img src="{{ $juri->foto_profile ? asset('storage/'.$juri->foto_profile) : asset('images/default.png') }}"
                                class="rounded-circle mb-3" width="120" height="120" alt="Foto Profil">
                        </div>
                        <h5 class="text-center fw-bold mb-1">{{ Auth::user()->name ?? 'Administrator' }}</h5>
                        <p class="text-center text-muted mb-0">
                            <i class="bi bi-envelope me-1"></i> {{ Auth::user()->email ?? 'admin@example.com' }}
                        </p>
                    </div>

                    <hr class="my-4">

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="card bg-light border-0">
                                <div class="card-body text-center p-3">
                                    <i class="bi bi-calendar-check text-primary fs-3 mb-2"></i>
                                    <p class="mb-1 text-muted small">Bergabung Sejak</p>
                                    <p class="mb-0 fw-bold">{{ Auth::user()->created_at->format('d M Y') ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-light border-0">
                                <div class="card-body text-center p-3">
                                    <i class="bi bi-shield-check text-success fs-3 mb-2"></i>
                                    <p class="mb-1 text-muted small">Role</p>
                                    <p class="mb-0 fw-bold">{{ ucfirst(Auth::user()->role ?? 'Juri') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 d-flex align-items-start mt-4 mb-0">
                        <i class="bi bi-lightbulb-fill me-2 mt-1"></i>
                        <small>Pastikan data akun Anda selalu ter-update untuk keamanan sistem</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🔔 Riwayat Aktivitas --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold">Riwayat Aktivitas Terkini</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center border-0 px-0">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-box-arrow-in-right text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold">Login terakhir</p>
                                <small class="text-muted">{{ now()->format('d M Y, H:i') }} WIB</small>
                            </div>
                            <span class="badge bg-success">Aktif</span>
                        </div>

                        <div class="list-group-item d-flex align-items-center border-0 px-0">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-key text-warning"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold">Password terakhir diubah</p>
                                <small class="text-muted">Belum pernah diubah</small>
                            </div>
                            <span class="badge bg-warning">Perhatian</span>
                        </div>

                        <div class="list-group-item d-flex align-items-center border-0 px-0">
                            <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-globe text-info"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold">Browser</p>
                                <small class="text-muted">Chrome / Windows</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> {{-- end row --}}

</div>

@endsection