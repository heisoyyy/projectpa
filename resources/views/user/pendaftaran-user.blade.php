@extends('user.komponen.komponen')

@section('title','Daftar Peserta')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-10">
            <div class="rounded h-100 p-4 shadow-sm">
                <h6 class="mb-4">Form Pendaftaran Tim LKBB Komando</h6>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @php
                $team = Auth::check() ? Auth::user()->team : null;
                $isVerified = $team && $team->status === 'verified';
                @endphp

                @if($team)
                <div class="alert alert-info">
                    Anda sudah melakukan pendaftaran tim. Gunakan tombol <strong>Cek</strong> 
                    @if(!$isVerified)
                        atau <strong>Ubah</strong>
                    @endif
                    .
                </div>
                @endif

                @if($isVerified)
                <div class="alert alert-success">
                    <i class="fa fa-check-circle"></i> <strong>Tim Anda sudah diverifikasi!</strong><br>
                    Data pendaftaran tidak dapat diubah setelah verifikasi. Jika ada perubahan mendesak, hubungi panitia.
                </div>
                @endif

                <form action="{{ $team ? route('user.pendaftaran.update', $team->id) : route('user.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($team) @method('PUT') @endif

                    <div class="mb-3">
                        <h6 class="form-label">Nama Tim</h6>
                        <input type="text" class="form-control" value="{{ Auth::user()->nama_sekolah }}" readonly>
                    </div>

                    <div class="mb-3">
                        <h6 class="form-label">Jumlah Peserta</h6>
                        <input type="number" id="jumlahPeserta" class="form-control" min="1" max="30" 
                               value="{{ $team ? $team->members->where('role','peserta')->count() : 0 }}" 
                               {{ $team || $isVerified ? 'disabled' : '' }}>
                    </div>
                    <div id="formPeserta"></div>

                    <div class="mb-3">
                        <h6 class="form-label">Jumlah Pelatih</h6>
                        <input type="number" id="jumlahPelatih" class="form-control" min="1" max="2" 
                               value="{{ $team ? $team->members->where('role','pelatih')->count() : 0 }}" 
                               {{ $team || $isVerified ? 'disabled' : '' }}>
                    </div>
                    <div id="formPelatih"></div>

                    <div class="text-end mt-3">
                        @if(!$team)
                        <button type="submit" class="btn btn-light">
                            <i class="fa fa-paper-plane"></i> Daftar
                        </button>
                        @endif
                        
                        @if($team && !$isVerified)
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahTimModal">
                            <i class="fa fa-edit"></i> Ubah
                        </button>
                        @endif
                        
                        @if($team)
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#cekTimModal">
                            <i class="fa fa-eye"></i> Cek
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('user.modals.modal_cek')
@if($team && !$isVerified)
    @include('user.modals.modal_ubah')
@endif

{{-- Optional: SweetAlert untuk notifikasi jika user coba akses saat verified --}}
@if($isVerified && session('attempt_edit'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        icon: 'warning',
        title: 'Data Tidak Dapat Diubah',
        text: 'Tim Anda sudah diverifikasi oleh admin. Data pendaftaran tidak dapat diubah lagi.',
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#ffc107'
    });
});
</script>
@endif

@endsection