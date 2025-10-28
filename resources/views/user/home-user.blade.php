@extends('user.komponen.komponen')

@section('title', 'Dashboard Peserta')

@section('content')
<div class="container-fluid pt-4 px-4">
    <h2 class="container py-4 mb-4 text-center">Dashboard Peserta</h2>
    <div class="row g-4">

        {{-- =================== STATUS AKUN =================== --}}
        <div class="col-12">
            <div class="rounded p-4 shadow-sm h-100">
                <h6 class="mb-3"><i class="fa fa-user-check text-success"></i> Status Akun</h6>
                <div class="d-flex flex-wrap justify-content-between align-items-center">

                    <div class="me-4 mb-2">
                        <p class="mb-1">Sekolah:</p>
                        <b>{{ Auth::user()->nama_sekolah }}</b>
                    </div>

                    {{-- Status Tim --}}
                    <div class="me-4 mb-2">
                        <p class="mb-1">Status:</p>
                        @if(!$team)
                        <span class="badge bg-secondary">Belum Daftar</span>
                        @elseif($team->status === 'verified')
                        <span class="badge bg-success">Terverifikasi</span>
                        @elseif($team->status === 'pending')
                        <span class="badge bg-warning">Belum Diverifikasi</span>
                        @else
                        <span class="badge bg-secondary">Tidak Diketahui</span>
                        @endif
                    </div>

                    {{-- Pelatih --}}
                    <div class="me-4 mb-2">
                        @php $pelatih = $team ? $team->members->where('role', 'pelatih') : collect(); @endphp
                        <p class="mb-1">Pelatih:</p>
                        <ul class="mb-0 ps-3">
                            @forelse($pelatih as $p)
                            <li><b>{{ $p->nama }}</b></li>
                            @empty
                            <li><i>Belum ada</i></li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="mb-2">
                        <a href="{{ url('user/profile-user') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-id-card"></i> Lihat Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- =================== JADWAL TAMPIL =================== --}}
        <div class="col-sm-12 col-lg-8">
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

                {{-- Tabel Preview --}}
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-hover align-middle text-center">
                        <thead>
                            <tr>
                                <th>Sekolah</th>
                                <th>Nomor Urut</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($sebelum)
                            <tr>
                                <td>{{ $sebelum->team->nama_tim ?? '-' }}</td>
                                <td>{{ $sebelum->urutan }}</td>
                                <td>{{ \Carbon\Carbon::parse($sebelum->waktu)->format('H:i') }}</td>
                            </tr>
                            @endif

                            <tr class="table-danger fw-bold">
                                <td>{{ Auth::user()->nama_sekolah }} (Anda)</td>
                                <td>{{ $jadwal->urutan }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</td>
                            </tr>

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

        {{-- =================== NOTIF & DOKUMEN & PENGUMUMAN =================== --}}
        <div class="col-sm-12 col-lg-4">
            <div class="rounded p-4 shadow-sm h-100">
                <h6 class="mb-3">Notifikasi Terbaru</h6>
                <ul class="list-group list-group-flush">
                    @forelse($notifikasi as $n)
                    <li class="list-group-item {{ $n->is_read ? '' : 'fw-bold' }}">
                        <div>{{ $n->judul }}</div>
                        <small class="text-muted">{{ $n->created_at->diffForHumans() }}</small>
                        <p class="mb-0">{{ $n->pesan }}</p>
                    </li>
                    @empty
                    <li class="list-group-item text-muted"><i>Tidak ada notifikasi</i></li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="rounded p-4 shadow-sm h-100">
                <h6 class="mb-3">Status Dokumen</h6>
                @php
                $pesertaCount = $team ? $team->members->where('role','peserta')->count() : 0;
                $dokumen1Uploaded = $team ? $team->members->where('role','peserta')->whereNotNull('dokumen_1')->count() : 0;
                $dokumen2Uploaded = $team ? $team->members->where('role','peserta')->whereNotNull('dokumen_2')->count() : 0;
                $suratIzinUploaded = Auth::user()->foto_surat_izin ? true : false;
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

        <div class="col-sm-12 col-lg-4">
            <div class="rounded p-4 shadow-sm h-100">
                <h6 class="mb-3">Pengumuman Panitia</h6>
                @forelse($pengumuman as $item)
                <p class="mb-2">
                    <strong>{{ $item->judul }}</strong><br>
                    <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                </p>
                @empty
                <p class="text-muted"><i>Tidak ada pengumuman untuk Anda</i></p>
                @endforelse
            </div>
        </div>
    </div>
</div>


{{-- ================= ALERT SWEETALERT ================= --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    async function showAlertsSequentially(alerts) {
        for (const alert of alerts) {
            switch(alert.type) {
                case 'belum_tim':
                    await Swal.fire({
                        icon: 'warning',
                        title: 'Lengkapi Data Tim',
                        text: 'Lengkapi data tim dan dokumen peserta terlebih dahulu sebelum melanjutkan.',
                        confirmButtonText: 'Oke',
                        confirmButtonColor: '#ffc107'
                    });
                    break;

                case 'dokumen_belum_lengkap':
                    await Swal.fire({
                        icon: 'warning',
                        title: 'Dokumen Belum Lengkap',
                        text: 'Harap lengkapi semua dokumen agar bisa diverifikasi.',
                        confirmButtonText: 'Oke',
                        confirmButtonColor: '#ffc107'
                    });
                    break;

                case 'dokumen_lengkap':
                    await Swal.fire({
                        icon: 'success',
                        title: 'Dokumen Lengkap',
                        text: 'Semua dokumen sudah lengkap. Menunggu verifikasi panitia.',
                        confirmButtonText: 'Oke',
                        confirmButtonColor: '#28a745'
                    });
                    break;

                case 'verified':
                    await Swal.fire({
                        icon: 'success',
                        title: 'Selamat!',
                        text: 'Status tim Anda sudah diverifikasi oleh admin.',
                        confirmButtonText: 'Oke',
                        confirmButtonColor: '#28a745'
                    });
                    break;

                case 'jadwal':
                    await Swal.fire({
                        icon: 'info',
                        title: 'Jadwal Sudah Ada!',
                        text: 'Tim Anda sudah mendapatkan jadwal tampil dari panitia.',
                        confirmButtonText: 'Lihat Jadwal',
                        confirmButtonColor: '#17a2b8'
                    });
                    break;

                default:
                    console.warn("Jenis alert tidak dikenali:", alert.type);
            }
        }
    }

    @if(session('dashboard_alerts'))
        const alerts = @json(session('dashboard_alerts'));
        console.log("Alerts aktif:", alerts);
        if (alerts && alerts.length > 0) {
            showAlertsSequentially(alerts);
        }
    @endif
});
</script>

@endsection