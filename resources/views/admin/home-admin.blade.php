@extends('admin.komponen.komponen')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid">
    <h3 class="mb-6 mt-8">Dashboard Admin</h3>
    {{-- Statistik --}}

    <div class="row g-4 mb-4 mt-6">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-primary border-3">
                <h6 class="text-muted">Sekolah Terdaftar</h6>
                <p class="fs-3 fw-bold text-primary">{{ $totalSekolah ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-success border-3">
                <h6 class="text-muted">Peserta Terverifikasi</h6>
                <p class="fs-3 fw-bold text-success">0</p> {{-- nanti bisa ganti pakai data real --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-warning border-3">
                <h6 class="text-muted">Jadwal Hari Ini</h6>
                <p class="fs-3 fw-bold text-warning">{{ $jadwalHariIni ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-danger border-3">
                <h6 class="text-muted">Pendaftaran Terakhir</h6>
                <p class="fs-3 fw-bold text-danger">{{ $waktuPendaftaranTerakhir ?? '-' }}</p>
            </div>
        </div>
    </div>


    {{-- Grafik --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h6 class="mb-3">Statistik Peserta</h6>
                <canvas id="pesertaChart" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h6 class="mb-3">Status Pendaftaran</h6>
                <canvas id="statusChart" height="200"></canvas>
            </div>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Aktivitas Terbaru</h6>
            <a href="{{ url('admin/daftar-admin') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama Peserta</th>
                        <th>Sekolah</th>
                        <th>Status</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Budi Santoso</td>
                        <td>SMAN 1 Pekanbaru</td>
                        <td><span class="badge bg-success">Terverifikasi</span></td>
                        <td>10 menit lalu</td>
                    </tr>
                    <tr>
                        <td>Siti Aminah</td>
                        <td>SMAN 2 Pekanbaru</td>
                        <td><span class="badge bg-warning">Diproses</span></td>
                        <td>20 menit lalu</td>
                    </tr>
                    <tr>
                        <td>Andi Pratama</td>
                        <td>SMAN 3 Pekanbaru</td>
                        <td><span class="badge bg-danger">Ditolak</span></td>
                        <td>30 menit lalu</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Actions --}}
    <h5 class="mb-3">Akses Cepat</h5>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ url('admin/daftar-admin') }}" class="btn btn-primary">
            <i class="fa fa-user-check me-2"></i>Verifikasi Peserta
        </a>
        <a href="{{ url('admin/kelola-homepage') }}" class="btn btn-secondary">
            <i class="fa fa-home me-2"></i>Kelola Homepage
        </a>
        <a href="{{ url('admin/jadwal-admin') }}" class="btn btn-success">
            <i class="fa fa-calendar-alt me-2"></i>Kelola Jadwal
        </a>
        <a href="{{ url('admin/hasil-admin') }}" class="btn btn-info">
            <i class="fa fa-pen me-2"></i>Input Nilai
        </a>
    </div>

</div>


@endsection