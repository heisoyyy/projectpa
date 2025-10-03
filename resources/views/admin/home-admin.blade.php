@extends('admin.komponen.komponen')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid py-4">
    <h2 class="mb-4">Dashboard Admin</h2>

    {{-- Statistik Ringkas --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-primary border-3">
                <h6 class="text-muted mb-2">Sekolah Terdaftar</h6>
                <p class="fs-3 fw-bold text-primary">{{ $totalSekolah ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-success border-3">
                <h6 class="text-muted mb-2">Peserta Terverifikasi</h6>
                <p class="fs-3 fw-bold text-success">{{ $verifiedCount ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-warning border-3">
                <h6 class="text-muted mb-2">Jadwal Hari Ini</h6>
                <p class="fs-3 fw-bold text-warning">{{ $jadwalHariIni ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-start border-danger border-3">
                <h6 class="text-muted mb-2">Pendaftaran Terakhir</h6>
                <p class="fs-3 fw-bold text-danger">{{ $waktuPendaftaranTerakhir ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="row mb-5">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow rounded-3">
                <div class="card-header bg-dark text-white d-flex align-items-center">
                    <i class="bi bi-people-fill me-2"></i>
                    <h6 class="mb-0">Statistik Peserta</h6>
                </div>
                <div class="card-body">
                    <canvas id="pesertaChart" style="height:260px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow rounded-3">
                <div class="card-header bg-dark text-white d-flex align-items-center">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    <h6 class="mb-0">Status Pendaftaran</h6>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" style="height:260px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Toggle Pendaftaran --}}
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Status Pendaftaran</h6>
            <form action="{{ route('admin.pendaftaran.toggle') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm {{ $setting->value == '1' ? 'btn-danger' : 'btn-success' }}">
                    {{ $setting->value == '1' ? 'Nonaktifkan' : 'Aktifkan' }}
                </button>
            </form>
        </div>
        <div class="card-body">
            <p class="mb-0">
                Saat ini:
                <span class="badge {{ $setting->value == '1' ? 'bg-success' : 'bg-danger' }}">
                    {{ $setting->value == '1' ? 'Pendaftaran Aktif' : 'Pendaftaran Nonaktif' }}
                </span>
            </p>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="card shadow-sm mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Aktivitas Terbaru</h6>
            <a href="{{ url('admin/daftar-admin') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-sm mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Sekolah</th>
                        <th>Aksi</th>
                        <th>Status</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestActivities as $activity)
                    <tr>
                        <td>{{ $activity->team->nama_tim ?? '-' }}</td>
                        <td>{{ $activity->action }}</td>
                        <td>
                            @if($activity->status == 'verified')
                            <span class="badge bg-success">Terverifikasi</span>
                            @elseif($activity->status == 'pending')
                            <span class="badge bg-warning">Belum Diverifikasi</span>
                            @else
                            <span class="badge bg-secondary">{{ ucfirst($activity->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $activity->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada aktivitas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Actions --}}
    <h5 class="mb-3">Akses Cepat</h5>
    <div class="d-flex flex-wrap gap-2 mb-5">
        <a href="{{ url('admin/daftar-admin') }}" class="btn btn-primary">
            <i class="fa fa-user-check me-2"></i>Verifikasi Peserta
        </a>
        <a href="{{ url('admin/homepage') }}" class="btn btn-secondary">
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