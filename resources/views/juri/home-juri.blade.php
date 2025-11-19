@extends('juri.komponen.komponen')

@section('title', 'Dashboard Juri')

@section('content')

<div class="container-fluid py-4">

    <h2 class="mb-4 fw-bold">Dashboard Juri</h2>

    <!-- =======================
         KARTU RINGKASAN
    ======================== -->
    <div class="row g-4 mb-4">

        <!-- Jumlah Peserta -->
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-4">
                <h6 class="text-secondary mb-1">Jumlah Peserta</h6>
                <h1 class="fw-bold text-primary">{{ $jumlahPeserta }}</h1>
            </div>
        </div>

        <!-- Jumlah Tim -->
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center border-4">
                <h6 class="text-secondary mb-1">Jumlah Tim</h6>
                <h1 class="fw-bold text-success">{{ $jumlahTim }}</h1>
            </div>
        </div>

        <!-- Jadwal Hari Ini -->
        <div class="col-md-6">
            <div class="card shadow-sm p-3 border-4">
                <h6 class="text-secondary mb-3">Jadwal Terdekat (Hari Ini)</h6>

                @if($jadwalHariIni->isEmpty())
                    <div class="text-center py-3">
                        <p class="text-muted mb-0">Tidak ada jadwal hari ini.</p>
                    </div>
                @else
                    <ul class="list-group mt-2">
                        @foreach($jadwalHariIni as $jadwal)
                        <li class="list-group-item border-0 shadow-sm rounded mb-2">

                            <div class="d-flex justify-content-between align-items-start">

                                <!-- Detail Kegiatan (Kiri) -->
                                <div>
                                    <div class="fw-bold fs-6">{{ $jadwal->kegiatan }}</div>
                                    <div class="small text-muted mt-1">
                                        Tim: <strong>{{ $jadwal->team->nama_tim }}</strong> <br>
                                        No Urut: <strong>{{ $jadwal->urutan }}</strong>
                                    </div>
                                </div>

                                <!-- Waktu (Kanan) -->
                                <div class="text-end">
                                    <span class="badge bg-primary px-3 py-2 fs-6">
                                        {{ $jadwal->waktu }}
                                    </span>
                                </div>

                            </div>

                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

    </div>


    <!-- =======================
         DAFTAR SEKOLAH & TIM
    ======================== -->
    <div class="card shadow-sm p-4 mb-4 border-4">
        <h5 class="text-secondary mb-3">Daftar Sekolah & Tim</h5>

        @if($teams->isEmpty())
            <p class="text-muted">Belum ada tim yang terdaftar.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Sekolah</th>
                            <th>Nama Tim</th>
                            <th>Jumlah Peserta</th>
                            <th>Jumlah Pelatih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $i => $team)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $team->user->nama_sekolah ?? '-' }}</td>
                            <td class="fw-semibold">{{ $team->nama_tim }}</td>
                            <td>{{ $team->members->where('role','peserta')->count() }}</td>
                            <td>{{ $team->members->where('role','pelatih')->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>


    <!-- =======================
         PROFIL JURI
    ======================== -->
    <div class="card shadow-sm p-4 border-4">
        <h5 class="text-secondary mb-3">Profil Juri</h5>

        <div class="row">
            <div class="col-md-6">
                <p><strong>Nama:</strong> {{ $profil->nama_sekolah }}</p>
                <p><strong>Email:</strong> {{ $profil->email }}</p>
            </div>

            <div class="col-md-6">
                <p><strong>No HP:</strong> {{ $profil->nomor_sekolah ?? '-' }}</p>
                <p><strong>Role:</strong> Juri</p>
            </div>
        </div>
    </div>

</div>

@endsection
