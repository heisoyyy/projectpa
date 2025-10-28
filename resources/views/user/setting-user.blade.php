@extends('user.komponen.komponen')

@section('title', 'Pengaturan Akun')

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

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-start">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-3 mt-1"></i>
            <div class="flex-grow-1">
                <strong>Terjadi Kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                            <h3 class="mb-1 fw-bold">Pengaturan Akun Peserta</h3>
                            <p class="mb-0 opacity-75">Kelola profil dan keamanan akun Anda</p>
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

        {{-- 👤 Profile Card --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-info bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold">Profil Saya</h5>
                    </div>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <img src="{{ Auth::user()->foto_profile ? asset('storage/'.Auth::user()->foto_profile): asset('images/default.png') }}"
                            class="rounded-circle mb-3" width="120" height="120" alt="Foto Profil">
                        <h4 class="fw-bold mb-1">{{ Auth::user()->name ?? 'Peserta' }}</h4>
                        <p class="text-muted mb-0">
                            <i class="bi bi-envelope me-1"></i> {{ Auth::user()->email ?? '-' }}
                        </p>
                    </div>

                    <hr class="my-4">

                    <div class="row g-3 text-start">
                        <div class="col-12">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-building text-primary fs-4 me-3"></i>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block">Nomor Sekolah</small>
                                            <p class="mb-0 fw-bold">{{ Auth::user()->nomor_sekolah ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-check text-success fs-4 me-3"></i>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block">Bergabung Sejak</small>
                                            <p class="mb-0 fw-bold">{{ Auth::user()->created_at->format('d M Y') ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shield-check text-warning fs-4 me-3"></i>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block">Status Akun</small>
                                            <p class="mb-0 fw-bold">
                                                <span class="badge bg-success">Aktif</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 d-flex align-items-start mt-4 mb-0">
                        <i class="bi bi-lightbulb-fill me-2 mt-1"></i>
                        <small class="text-start">Ingin mengubah data profil? <a href="{{ url('user/profile-user') }}">Klik</a></small>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🔑 Ubah Password --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
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
                        <div>
                            <strong>Perhatian!</strong> Setelah berhasil mengubah password, Anda akan otomatis logout dan harus login kembali dengan password baru.
                        </div>
                    </div>

                    <form action="{{ route('user.setting.updatePassword') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nomor Sekolah Verifikasi --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-building text-muted me-1"></i> Nomor Sekolah (Verifikasi)
                            </label>
                            <input type="text"
                                name="nomor_sekolah"
                                value="{{ old('nomor_sekolah') }}"
                                class="form-control form-control-lg @error('nomor_sekolah') is-invalid @enderror"
                                placeholder="Masukkan nomor sekolah Anda"
                                required>
                            @error('nomor_sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-flex align-items-center mt-2">
                                <i class="bi bi-shield-check me-1"></i> Masukkan nomor sekolah sebagai verifikasi identitas
                            </small>
                        </div>

                        <hr class="my-4">

                        {{-- Password Lama --}}
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

                        {{-- Password Baru --}}
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
                                <i class="bi bi-shield-check me-1"></i> Minimal 8 karakter, gunakan kombinasi huruf, angka, dan simbol
                            </small>
                        </div>

                        {{-- Konfirmasi Password --}}
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
                                <i class="bi bi-save me-2"></i> Simpan Perubahan Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- 🔔 Riwayat Aktivitas --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold">Riwayat Aktivitas Terkini</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center border-0 px-0 py-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-box-arrow-in-right text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold">Login terakhir</p>
                                <small class="text-muted">{{ now()->format('d M Y, H:i') }} WIB</small>
                            </div>
                            <span class="badge bg-success">Aktif</span>
                        </div>

                        <div class="list-group-item d-flex align-items-center border-0 px-0 py-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-key text-warning fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold">Password terakhir diubah</p>
                                <small class="text-muted">
                                    {{ Auth::user()->updated_at->format('d M Y, H:i') ?? 'Belum pernah diubah' }}
                                </small>
                            </div>
                            <span class="badge bg-warning">Perhatian</span>
                        </div>

                        <div class="list-group-item d-flex align-items-center border-0 px-0 py-3">
                            <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-globe text-info fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold">Browser & Device</p>
                                <small class="text-muted">Chrome / Windows</small>
                            </div>
                        </div>

                        <div class="list-group-item d-flex align-items-center border-0 px-0 py-3">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-geo-alt text-danger fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold">Lokasi Login</p>
                                <small class="text-muted">Pekanbaru, Riau, Indonesia</small>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 d-flex align-items-start mt-3 mb-0">
                        <i class="bi bi-shield-check me-2 mt-1"></i>
                        <small>Jika Anda melihat aktivitas mencurigakan, segera ubah password dan hubungi administrator.</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- 💡 Tips Keamanan --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-secondary bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold">Tips Keamanan Akun</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-primary bg-opacity-25 rounded-circle p-2 me-3 flex-shrink-0">
                                            <i class="bi bi-key-fill text-primary fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-2">Password Kuat</h6>
                                            <p class="mb-0 small text-muted">Gunakan minimal 8 karakter dengan kombinasi huruf besar, kecil, angka, dan simbol.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-warning bg-opacity-25 rounded-circle p-2 me-3 flex-shrink-0">
                                            <i class="bi bi-shield-lock-fill text-warning fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-2">Jangan Berbagi</h6>
                                            <p class="mb-0 small text-muted">Jangan pernah membagikan password Anda kepada siapapun, termasuk teman atau keluarga.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-success bg-opacity-25 rounded-circle p-2 me-3 flex-shrink-0">
                                            <i class="bi bi-arrow-repeat text-success fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-2">Ganti Berkala</h6>
                                            <p class="mb-0 small text-muted">Ubah password secara berkala minimal 3-6 bulan sekali untuk keamanan maksimal.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-danger border-0 d-flex align-items-start mt-3 mb-0">
                        <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>
                        <small><strong>Peringatan:</strong> Jangan gunakan password yang sama dengan akun lain (email, media sosial, dll) untuk menghindari kebocoran data.</small>
                    </div>
                </div>
            </div>
        </div>

    </div> {{-- end row --}}

</div>

@endsection