@extends('user.komponen.komponen')

@section('title', 'Jadwal Peserta')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="rounded h-100 p-4 shadow-sm">
                <h6 class="mb-4">Jadwal Tampil Tim</h6>

                {{-- Info status verifikasi --}}
                <div class="alert alert-info d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Status Verifikasi:</strong>
                        @if($jadwal)
                        <span class="badge bg-success">Sudah Terjadwal</span>
                        @else
                        <span class="badge bg-warning">Belum Ada Jadwal</span>
                        @endif
                    </div>
                    <div>
                        <i class="fa fa-bullhorn"></i> Jangan lupa hadir 30 menit sebelum tampil!
                    </div>
                </div>

                @if(!$jadwal)
                <div class="alert alert-warning">
                    Jadwal tampil tim Anda belum ditentukan oleh panitia.
                </div>
                @else
                {{-- Tabel Jadwal (sebelum - anda - sesudah) --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Sekolah</th>
                                <th>Hari Tampil</th>
                                <th>Jam Tampil</th>
                                <th>Nomor Urut</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Peserta sebelum --}}
                            @if($sebelum)
                            <tr>
                                <td>{{ $sebelum->team->nama_sekolah ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($sebelum->tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($sebelum->waktu)->format('H:i') }} WIB</td>
                                <td>{{ $sebelum->urutan }}</td>
                                <td><span class="badge bg-secondary">Sudah Tampil</span></td>
                            </tr>
                            @endif

                            {{-- Jadwal Anda --}}
                            <tr class="table-primary fw-bold">
                                <td>{{ $jadwal->team->nama_sekolah ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</td>
                                <td>{{ $jadwal->urutan }}</td>
                                <td><span class="badge bg-primary">Giliran Anda</span></td>
                            </tr>

                            {{-- Peserta sesudah --}}
                            @if($sesudah)
                            <tr>
                                <td>{{ $sesudah->team->nama_sekolah ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($sesudah->tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($sesudah->waktu)->format('H:i') }} WIB</td>
                                <td>{{ $sesudah->urutan }}</td>
                                <td><span class="badge bg-warning">Menunggu</span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <hr>

                {{-- Countdown Otomatis --}}
                <div class="text-center mt-3">
                    <h6>Hitung Mundur Menuju Giliran Anda</h6>
                    <div id="countdown" class="fs-4 fw-bold text-danger">Memuat...</div>
                </div>
                @endif

                <hr>

                {{-- Catatan Panitia --}}
                <div class="alert alert-warning mt-3">
                    <i class="fa fa-info-circle"></i> <strong>Catatan Panitia:</strong>
                    Harap semua peserta sudah berada di area tunggu sebelum jam tampil.
                </div>
            </div>
        </div>
    </div>
</div>

@if($jadwal)
<script>
    // ambil target waktu tampil dikurangi 15 menit
    const tampilTime = new Date("{{ $jadwal->tanggal }} {{ $jadwal->waktu }}").getTime();
    const targetTime = tampilTime - (15 * 60 * 1000); // 15 menit sebelum tampil

    const countdownEl = document.getElementById("countdown");

    const timer = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetTime - now;

        if (distance <= 0) {
            clearInterval(timer);
            countdownEl.innerHTML = "Saatnya bersiap!";
            countdownEl.classList.remove("text-danger");
            countdownEl.classList.add("text-success");
        } else {
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.innerHTML =
                String(hours).padStart(2, '0') + ":" +
                String(minutes).padStart(2, '0') + ":" +
                String(seconds).padStart(2, '0');
        }
    }, 1000);
</script>
@endif


@endsection