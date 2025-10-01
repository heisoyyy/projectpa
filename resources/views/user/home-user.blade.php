@extends('user.komponen.komponen')

@section('title', 'Peserta LKBB')

@section('content')
<!-- Content -->

<div class="container-fluid pt-4 px-4">
    <h2 class="container py-4 mb-4 text-center">Dashboard Peserta</h2>
    <div class="row g-4">
        <!-- Status Akun -->
        <div class="col-sm-12 col-lg-12">
            <div class="rounded p-4 shadow-sm h-100">
                <h6 class="mb-3"><i class="fa fa-user-check text-success"></i> Status Akun</h6>
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <!-- Sekolah -->
                    <div class="me-4 mb-2">
                        <p class="mb-1">Sekolah:</p>
                        <b>{{ Auth::user()->nama_sekolah }}</b>
                    </div>

                    <!-- Status Tim -->
                    <div class="me-4 mb-2">
                        @php $team = Auth::user()->team; @endphp
                        <p class="mb-1">Status:</p>
                        @if($team)
                        @if($team->status == 'pending')
                        <span class="badge bg-warning">Belum Diverifikasi</span>
                        @elseif($team->status == 'verified')
                        <span class="badge bg-success">Terverifikasi</span>
                        @else
                        <span class="badge bg-secondary">Tidak Diketahui</span>
                        @endif
                        @else
                        <span class="badge bg-secondary">Belum Daftar</span>
                        @endif
                    </div>

                    <!-- Pelatih -->
                    <div class="me-4 mb-2">
                        @php
                        $pelatih = $team ? $team->members->where('role', 'pelatih') : collect();
                        @endphp
                        <p class="mb-1">Pelatih:</p>
                        <ul class="mb-0 ps-3">
                            @forelse($pelatih as $p)
                            <li><b>{{ $p->nama }}</b></li>
                            @empty
                            <li><i>Belum ada</i></li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Tombol Profil -->
                    <div class="mb-2">
                        <a href="{{ url('user/profile-user') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-id-card"></i> Lihat Profil
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Jadwal Tampil -->
        <div class="col-sm-12 col-lg-8 ">
            <div class="rounded p-4 shadow-sm h-100">
                <h6 class="mb-3"><i class="fa fa-calendar"></i> Jadwal & Nomor Urut</h6>

                @if(!$team || !$jadwal)
                <div class="alert alert-warning text-center">
                    Jadwal tampil tim Anda belum ditentukan oleh panitia.
                </div>
                @else
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="rounded p-3">
                            <small class="text-muted">Tanggal</small>
                            <h5 class="mb-0">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y') }}</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="rounded p-3">
                            <small class="text-muted">Jam Tampil</small>
                            <h5 class="mb-0">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="rounded p-3">
                            <small class="text-muted">Urutan</small>
                            <h5 class="mb-0">{{ $jadwal->urutan }}</h5>
                        </div>
                    </div>
                </div>

                <!-- Preview Urutan -->
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead>
                            <tr>
                                <th width="250px">Sekolah</th>
                                <th width="100px">Nomor Urut</th>
                                <th width="120px">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Peserta sebelum --}}
                            @if($sebelum)
                            <tr>
                                <td>{{ $sebelum->team->nama_tim ?? '-' }}</td>
                                <td>{{ $sebelum->urutan }}</td>
                                <td>{{ \Carbon\Carbon::parse($sebelum->waktu)->format('H:i') }}</td>
                            </tr>
                            @endif

                            {{-- Jadwal Anda --}}
                            <tr class="table-danger fw-bold">
                                <td>{{ Auth::user()->nama_sekolah }} (Anda)</td>
                                <td><b>{{ $jadwal->urutan }}</b></td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</td>
                            </tr>

                            {{-- Peserta sesudah --}}
                            @if($sesudah)
                            <tr>
                                <td>{{ $sesudah->team->nama_tim ?? '-' }}</td>
                                <td>{{ $sesudah->urutan }}</td>
                                <td>{{ \Carbon\Carbon::parse($sesudah->waktu)->format('H:i') }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Aktivitas, Dokumen & Pengumuman -->
    <div class="row g-4 mt-2">

        <!-- Aktivitas -->
        <div class="col-sm-12 col-lg-4">
            <div class="rounded p-4 shadow-sm h-100">
                <h6 class="mb-3">Aktivitas Terbaru</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Akun berhasil diverifikasi</li>
                    <li class="list-group-item">Jadwal tampil telah diumumkan</li>
                    <li class="list-group-item">Besok giliran tampil, persiapkan diri</li>
                </ul>
            </div>
        </div>

        <!-- Status Dokumen -->
        <div class="col-sm-12 col-lg-4 c">
            <div class="rounded p-4 shadow-sm h-100">
                <h6 class="mb-3">Status Dokumen</h6>

                {{-- Hitung status dokumen --}}
                @php
                $pesertaCount = $team ? $team->members->where('role','peserta')->count() : 0;
                $dokumen1Uploaded = $team ? $team->members->where('role','peserta')->whereNotNull('dokumen_1')->count() : 0;
                $dokumen2Uploaded = $team ? $team->members->where('role','peserta')->whereNotNull('dokumen_2')->count() : 0;
                $suratIzinUploaded = Auth::user()->foto_surat_izin ? true : false;

                // cek kelengkapan
                $isComplete = $pesertaCount > 0 && $dokumen1Uploaded > 0 && $dokumen2Uploaded > 0 && $suratIzinUploaded;
                @endphp

                <p>Peserta:
                    @if($pesertaCount > 0)
                    <span class="badge bg-success">Lengkap</span>
                    @else
                    <span class="badge bg-warning">Isi Terlebih Dahulu</span>
                    @endif
                </p>

                <p>Kartu Pelajar:
                    @if($dokumen1Uploaded > 0)
                    <span class="badge bg-success">Upload</span>
                    @else
                    <span class="badge bg-danger">Belum Upload</span>
                    @endif
                </p>

                <p>Pas Photo:
                    @if($dokumen2Uploaded > 0)
                    <span class="badge bg-success">Upload</span>
                    @else
                    <span class="badge bg-danger">Belum Upload</span>
                    @endif
                </p>

                <p>Surat Izin:
                    @if($suratIzinUploaded)
                    <span class="badge bg-success">Upload</span>
                    @else
                    <span class="badge bg-danger">Belum Upload</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Pengumuman -->
        <div class="col-sm-12 col-lg-4" id="pengumuman">
            <div class="rounded p-4 shadow-sm h-100">
                <h6 class="mb-3">Pengumuman Panitia</h6>

                @forelse($pengumuman as $item)
                <p class="mb-2">
                    <strong>{{ $item->judul }}</strong>
                    <br><small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                </p>
                @empty
                <p class="text-muted"><i>Tidak ada pengumuman untuk Anda</i></p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@php
use Carbon\Carbon;

$popupMessage = null;
if($jadwal) {
$jadwalTime = Carbon::parse($jadwal->tanggal.' '.$jadwal->waktu);
$now = Carbon::now();

// 10 menit sebelum tampil
if ($now->between($jadwalTime->copy()->subMinutes(10), $jadwalTime->copy()->subMinutes(9))) {
$popupMessage = "Giliran tampil Anda akan dimulai 10 menit lagi!";
}

// 1 menit sebelum tampil
if ($now->between($jadwalTime->copy()->subMinute(), $jadwalTime)) {
$popupMessage = "Giliran tampil Anda akan dimulai 1 menit lagi!";
}
}
@endphp

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($popupMessage)
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: 'Pengingat Jadwal!',
            text: "{{ $popupMessage }}",
            icon: 'info',
            confirmButtonText: 'Siap!'
        });
    });
</script>
@endif

{{-- Alert untuk status dokumen --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if($isComplete)
        Swal.fire({
            icon: 'success',
            title: '✅ Dokumen Lengkap',
            text: 'Semua dokumen sudah lengkap. Menunggu verifikasi panitia.',
            timer: 4000,
            showConfirmButton: false
        });
        @else
        Swal.fire({
            icon: 'warning',
            title: '⚠️ Dokumen Belum Lengkap',
            text: 'Harap lengkapi semua dokumen agar bisa diverifikasi.',
            confirmButtonText: 'Oke'
        });
        @endif
    });
</script>