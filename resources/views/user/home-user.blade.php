@extends('.user.komponen.user-komponen')

@section('title', 'Dashboard Peserta')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <!-- Status Akun -->
        <div class="col-sm-12 col-lg-12">
            <div class="bg-white rounded p-4 shadow-sm h-100">
                <h6 class="mb-3"><i class="fa fa-user-check text-success"></i> Status Akun</h6>

                <div class="d-flex flex-wrap justify-content-between align-items-center">

                    <!-- Sekolah -->
                    <div class="me-4 mb-2">
                        <p class="mb-1">Sekolah:</p>
                        <b>{{ Auth::user()->nama_sekolah }}</b>
                    </div>

                    <!-- Status -->
                    <div class="me-4 mb-2">
                        <p class="mb-1">Status:</p>
                        <span class="badge bg-success">Terverifikasi</span>
                    </div>

                    <!-- Pelatih -->
                    <div class="me-4 mb-2">
                        @php
                        $team = Auth::user()->team;
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
        <div class="col-sm-12 col-lg-8">
            <div class="bg-white rounded p-4 shadow-sm h-100">
                <h6 class="mb-3"><i class="fa fa-calendar"></i> Jadwal & Nomor Urut</h6>
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="bg-light rounded p-3">
                            <small class="text-muted">Tanggal</small>
                            <h5 class="mb-0">14 Nov 2025</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded p-3">
                            <small class="text-muted">Jam Tampil</small>
                            <h5 class="mb-0">09:20</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded p-3">
                            <small class="text-muted">Urutan</small>
                            <h5 class="mb-0">12</h5>
                        </div>
                    </div>
                </div>

                <!-- Preview Urutan -->
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Sekolah</th>
                                <th>Nomor Urut</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-danger">
                                <td>SMAN 1 Pekanbaru (Anda)</td>
                                <td><b>12</b></td>
                                <td>09:20</td>
                            </tr>
                            <tr>
                                <td>SMAN 2 Pekanbaru</td>
                                <td>13</td>
                                <td>09:40</td>
                            </tr>
                            <tr>
                                <td>SMAN 3 Pekanbaru</td>
                                <td>14</td>
                                <td>10:00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Notifikasi, Dokumen & Pengumuman -->
    <div class="row g-4 mt-2">

        <!-- Notifikasi -->
        <div class="col-sm-12 col-lg-4">
            <div class="bg-white rounded p-4 shadow-sm h-100">
                <h6 class="mb-3"><i class="fa fa-bell text-warning"></i> Notifikasi Terbaru</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">✅ Akun berhasil diverifikasi</li>
                    <li class="list-group-item">📢 Jadwal tampil telah diumumkan</li>
                    <li class="list-group-item">⏰ Besok giliran tampil, persiapkan diri</li>
                </ul>
            </div>
        </div>

        <!-- Status Dokumen -->
        <div class="col-sm-12 col-lg-4">
            <div class="bg-white rounded p-4 shadow-sm h-100">
                <h6 class="mb-3"><i class="fa fa-folder-open text-info"></i> Status Dokumen</h6>
                <p>Peserta: <span class="badge bg-success">Lengkap</span></p>
                <p>Kartu Pelajar: <span class="badge bg-success">Upload ✔</span></p>
                <p>Rapor: <span class="badge bg-success">Upload ✔</span></p>
                <p>Surat Izin: <span class="badge bg-danger">Belum Upload ❌</span></p>
            </div>
        </div>

        <!-- Pengumuman -->
        <div class="col-sm-12 col-lg-4" id="pengumuman">
            <div class="bg-white rounded p-4 shadow-sm h-100">
                <h6 class="mb-3"><i class="fa fa-bullhorn text-danger"></i> Pengumuman Panitia</h6>

                <p class="mb-2">📌 Seluruh peserta diharapkan hadir 30 menit sebelum jadwal tampil.</p>
                <p class="mb-2">📌 Pastikan seragam sesuai ketentuan.</p>
                <p class="mb-2">📌 Jangan lupa membawa kartu peserta.</p>
                <p class="mb-0">📌 Kontak panitia jika ada kendala teknis.</p>
            </div>
        </div>

    </div>
</div>
@endsection