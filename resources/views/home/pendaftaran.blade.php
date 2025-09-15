@extends('home.komponen.home-ofc')

@section('title', 'Pendaftaran - LKBB Komando')

@section('content')
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>Pendaftaran</h3>
      </div>
    </div>
  </div>
</div>

<div class="properties section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="section-heading text-center">
          <h6>| LKBB Komando 2025</h6>
          <h2>Form Pendaftaran LKBB Komando 2025</h2>
        </div>

        <!-- Flash Message -->
        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
        @endif

        <form class="registration-form" action="{{ route('register.post') }}" method="POST">
          @csrf

          @error('email')
          <small class="text-danger">{{ $message }}</small>
          @enderror

          <!-- Email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email aktif" required>
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
          </div>

          <!-- Konfirmasi Password -->
          <div class="form-group">
            <label for="password_confirmation">Ulangi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
          </div>

          <!-- Nama Sekolah -->
          <div class="form-group">
            <label for="nama_sekolah">Nama Sekolah</label>
            <input type="text" id="nama_sekolah" name="nama_sekolah" class="form-control" placeholder="Masukkan nama sekolah" required>
          </div>

          <!-- Nomor Sekolah -->
          <div class="form-group">
            <label for="nomor_sekolah">Nomor Sekolah</label>
            <input type="text" id="nomor_sekolah" name="nomor_sekolah" class="form-control" placeholder="Masukkan nomor sekolah" required>
          </div>

          <!-- Kota -->
          <div class="form-group">
            <label for="kota">Kota / Kabupaten</label>
            <input type="text" id="kota" name="kota" class="form-control" placeholder="Masukkan kota/kabupaten" required>
          </div>

          <div class="icon-button text-center">
            <button type="submit" class="btn-submit">
              <i class="fa fa-paper-plane"></i> KIRIM PENDAFTARAN
            </button>
          </div>
        </form>


      </div>
    </div>
  </div>
</div>
@endsection