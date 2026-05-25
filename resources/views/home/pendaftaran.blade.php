@extends('home.komponen.home-ofc')

@section('title', 'Pendaftaran - LKBB Komando')

@section('content')

{{-- ✅ Page Heading --}}
<div class="page-heading header-text"
  style="background: url('{{ Storage::url($informasi->background) }}') no-repeat center center/cover; position:relative;">
  <div style="position:absolute;inset:0;background:rgba(80,0,0,0.55);"></div>
  <div class="container" style="position:relative;z-index:1;">
    <div class="row">
      <div class="col-lg-12 text-center">
        <small style="color:rgba(255,255,255,0.7);letter-spacing:3px;text-transform:uppercase;font-size:13px;">LKBB Komando 2025</small>
        <h3 style="color:#fff;font-weight:700;font-size:2.2rem;margin:6px 0 0;text-shadow:2px 2px 8px rgba(0,0,0,0.4);">Pendaftaran</h3>
      </div>
    </div>
  </div>
</div>

{{-- ✅ Form Section --}}
<div class="properties section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-9">

        {{-- Section Heading --}}
        <div class="text-center mb-4">
          <span style="color:#800000;font-weight:700;letter-spacing:2px;font-size:12px;text-transform:uppercase;">| LKBB Komando 2025</span>
          <h2 class="fw-bold mt-2 mb-2" style="font-size:1.7rem;">Form Pendaftaran</h2>
          <div style="width:50px;height:4px;background:#800000;border-radius:2px;margin:0 auto;"></div>
        </div>

        @php
          $pendaftaran = \App\Models\Setting::where('key','pendaftaran_enabled')->first();
        @endphp

        {{-- ✅ Pendaftaran DITUTUP --}}
        @if(!$pendaftaran || $pendaftaran->value == '0')
        <div class="text-center py-5 px-4 rounded-4 border"
          style="background:#fff;box-shadow:0 8px 32px rgba(128,0,0,0.08);">
          <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3"
            style="width:72px;height:72px;background:rgba(128,0,0,0.08);">
            <i class="fa fa-ban" style="font-size:32px;color:#800000;"></i>
          </div>
          <h5 class="fw-bold mb-2" style="color:#800000;">Pendaftaran Ditutup</h5>
          <p class="text-muted mb-0" style="font-size:0.92rem;">
            Pendaftaran LKBB Komando 2025 saat ini sedang <strong>ditutup</strong>.<br>
            Pantau terus informasi terbaru kami.
          </p>
        </div>

        {{-- ✅ Pendaftaran BUKA --}}
        @else

        {{-- Alert --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Form Card --}}
        <div class="p-4 p-lg-5 rounded-4 border"
          style="background:#fff;box-shadow:0 8px 32px rgba(128,0,0,0.08);">

          <h6 class="fw-bold mb-1" style="color:#800000;">Data Akun & Sekolah</h6>
          <p class="text-muted mb-4" style="font-size:0.88rem;">
            Lengkapi semua data di bawah ini untuk mendaftar. Kolom bertanda <span class="text-danger">*</span> wajib diisi.
          </p>

          <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="row g-3">

              {{-- Email --}}
              <div class="col-12">
                <label class="form-label fw-semibold" style="font-size:0.88rem;">
                  Email <span class="text-danger">*</span>
                </label>
                <input type="email" name="email"
                  class="form-control @error('email') is-invalid @enderror"
                  placeholder="Masukkan email aktif"
                  value="{{ old('email') }}" required
                  style="font-size:0.9rem;">
                @error('email')<small class="text-danger mt-1 d-block">{{ $message }}</small>@enderror
              </div>

              {{-- Password --}}
              <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size:0.88rem;">
                  Password <span class="text-danger">*</span>
                </label>
                <input type="password" name="password"
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="Buat password" required
                  style="font-size:0.9rem;">
                @error('password')<small class="text-danger mt-1 d-block">{{ $message }}</small>@enderror
              </div>

              {{-- Konfirmasi Password --}}
              <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size:0.88rem;">
                  Ulangi Password <span class="text-danger">*</span>
                </label>
                <input type="password" name="password_confirmation"
                  class="form-control"
                  placeholder="Ulangi password" required
                  style="font-size:0.9rem;">
              </div>

              {{-- Divider --}}
              <div class="col-12 mt-1">
                <hr style="border-color:rgba(128,0,0,0.15);">
                <small class="text-muted" style="font-size:0.82rem;letter-spacing:.5px;text-transform:uppercase;">
                  Data Sekolah
                </small>
              </div>

              {{-- Nama Sekolah --}}
              <div class="col-12">
                <label class="form-label fw-semibold" style="font-size:0.88rem;">
                  Nama Sekolah <span class="text-danger">*</span>
                </label>
                <input type="text" name="nama_sekolah"
                  class="form-control @error('nama_sekolah') is-invalid @enderror"
                  placeholder="Masukkan nama sekolah"
                  value="{{ old('nama_sekolah') }}" required
                  style="font-size:0.9rem;">
                @error('nama_sekolah')<small class="text-danger mt-1 d-block">{{ $message }}</small>@enderror
              </div>

              {{-- Nomor Sekolah & Kota --}}
              <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size:0.88rem;">
                  Nomor Sekolah <span class="text-danger">*</span>
                </label>
                <input type="text" name="nomor_sekolah"
                  class="form-control @error('nomor_sekolah') is-invalid @enderror"
                  placeholder="Nomor sekolah"
                  value="{{ old('nomor_sekolah') }}" required
                  style="font-size:0.9rem;">
                @error('nomor_sekolah')<small class="text-danger mt-1 d-block">{{ $message }}</small>@enderror
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size:0.88rem;">
                  Kota / Kabupaten <span class="text-danger">*</span>
                </label>
                <input type="text" name="kota"
                  class="form-control @error('kota') is-invalid @enderror"
                  placeholder="Kota / kabupaten"
                  value="{{ old('kota') }}" required
                  style="font-size:0.9rem;">
                @error('kota')<small class="text-danger mt-1 d-block">{{ $message }}</small>@enderror
              </div>

              {{-- Submit --}}
              <div class="col-12 mt-2">
                <button type="submit" id="btn-submit"
                  class="btn w-100 py-3 fw-bold"
                  style="background:#800000;color:#fff;border-radius:8px;letter-spacing:.5px;font-size:0.95rem;border:none;transition:all .3s;">
                  Kirim Pendaftaran
                </button>
              </div>

              {{-- Link Login --}}
              <div class="col-12 text-center">
                <small class="text-muted">
                  Sudah punya akun?
                  <a href="{{ url('/home/login') }}" style="color:#800000;font-weight:600;">Masuk di sini</a>
                </small>
              </div>

            </div>
          </form>
        </div>
        @endif

      </div>
    </div>
  </div>
</div>

{{-- ✅ Style --}}
<style>
  .form-control:focus {
    border-color: #800000;
    box-shadow: 0 0 0 3px rgba(128,0,0,0.12);
  }
  #btn-submit:hover {
    background: #600000 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(128,0,0,0.3);
  }
</style>

@endsection