@extends('.user.komponen.user-komponen')

@section('title', 'Profile Peserta')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-lg-8">
            <div class="bg-white rounded p-4 shadow-sm h-100">
                <h5 class="mb-4"><i class="fa fa-user"></i> Profil Peserta</h5>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" value="{{ $user->email }}" class="form-control" readonly>
                    </div>

                    <!-- Nama Sekolah -->
                    <div class="mb-3">
                        <label class="form-label">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah',$user->nama_sekolah) }}" class="form-control">
                    </div>

                    <!-- Nomor Sekolah -->
                    <div class="mb-3">
                        <label class="form-label">Nomor Sekolah</label>
                        <input type="text" value="{{ $user->nomor_sekolah }}" class="form-control" readonly>
                    </div>

                    <!-- Kota / Kabupaten -->
                    <div class="mb-3">
                        <label class="form-label">Kota/Kabupaten</label>
                        <input type="text" name="kota" value="{{ old('kota',$user->kota) }}" class="form-control">
                    </div>

                    <!-- Upload Surat Izin -->
                    <div class="mb-3">
                        <label class="form-label">Surat Izin Sekolah</label>
                        @if($user->foto_surat_izin)
                        <p><a href="{{ asset('storage/'.$user->foto_surat_izin) }}" target="_blank">Lihat Surat</a></p>
                        @endif
                        <input type="file" name="foto_surat_izin" class="form-control">
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status Akun</label><br>
                        @if($user->is_verified ?? false)
                        <span class="badge bg-success">Terverifikasi</span>
                        @else
                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                        @endif
                    </div>

                    <!-- Tanggal Pendaftaran -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Pendaftaran</label>
                        <input type="text" value="{{ $user->created_at->format('d-m-Y H:i') }}" class="form-control" readonly>
                    </div>

                    <!-- Simpan Button -->
                    <button type="submit" class="btn btn-light">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <!-- Foto Profil -->
        <div class="col-lg-4">
            <div class="bg-white rounded p-4 shadow-sm h-100 text-center">
                <h6>Foto Profil</h6>
                <img src="{{ $user->foto_profile 
                            ? asset('storage/'.$user->foto_profile) 
                            : asset('assets/a2/img/user.jpg') }}"
                    alt="Foto Profil" class="rounded-circle mb-3"
                    style="width:120px; height:120px; object-fit:cover;">

                <form action="{{ route('user.profile.uploadFoto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="foto_profile" class="form-control mb-2" required>
                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-upload"></i> Upload Foto
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection