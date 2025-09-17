@extends('user.komponen.komponen')

@section('title', 'Setting Peserta')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="rounded p-4 shadow-sm h-100">
                <h5 class="mb-4"><i class="fa fa-cog"></i> Pengaturan Akun</h5>

                {{-- Pesan sukses --}}
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Pesan error --}}
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('user.setting.updatePassword') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nomor Sekolah -->
                    <div class="mb-3">
                        <label class="form-label">Nomor Sekolah</label>
                        <input type="text"
                            name="nomor_sekolah"
                            value="{{ Auth::user()->nomor_sekolah }}"
                            class="form-control" required>
                        <small class="text-muted">Masukkan nomor sekolah Anda sebagai verifikasi.</small>
                    </div>

                    <!-- Password Lama -->
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" required>
                    </div>

                    <!-- Password Baru -->
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" required>
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_baru_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-light">
                        <i class="fa fa-key"></i> Simpan Password
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="bg-light rounded p-4 shadow-sm h-100">
                <h6>Tips Keamanan</h6>
                <ul class="mb-0">
                    <li>Gunakan password minimal 8 karakter.</li>
                    <li>Campurkan huruf besar, huruf kecil, angka, dan simbol.</li>
                    <li>Jangan gunakan password yang sama dengan akun lain.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection