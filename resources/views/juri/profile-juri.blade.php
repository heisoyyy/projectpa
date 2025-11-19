<!-- views/juri/profile-juri.blade.php -->
@extends('juri.komponen.komponen')

@section('title', 'Profile Juri')

@section('content')

<h2 class="mb-4 mt-4">Profile Juri</h2>

<div class="row">
  <!-- Info Profile -->
  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <img src="{{ $juri->foto_profile ? asset('storage/'.$juri->foto_profile) : asset('images/default.png') }}"
          class="rounded-circle mb-3" width="120" height="120" alt="Foto Profil">
        <h5>{{ $juri->nama_sekolah ?? 'Juri' }}</h5>
        <p class="text-muted">{{ $juri->email }}</p>
        <p class="text-muted">Nomor HP: {{ $juri->nomor_sekolah }}</p>
      </div>
    </div>
  </div>

  <!-- Form Update Profile -->
  <div class="col-md-8">
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Update Profil</h5>
      </div>
      <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('juri.profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $juri->nama_sekolah) }}">
            @error('nama_sekolah') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Nomor Hp</label>
            <input type="text" name="nomor_sekolah" class="form-control" value="{{ old('nomor_sekolah', $juri->nomor_sekolah) }}">
            @error('nomor_sekolah') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $juri->email) }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" name="foto_profile" class="form-control">
            @error('foto_profile') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection