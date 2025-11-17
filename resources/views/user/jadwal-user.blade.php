@extends('user.komponen.komponen')

@section('title', 'Jadwal Peserta')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="rounded h-100 p-4 shadow-sm">
                <h6 class="mb-4"><i class="fa fa-calendar"></i> Jadwal Tampil Tim</h6>

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
                    <div class="alert alert-warning text-center">
                        <i class="fa fa-clock"></i> Jadwal tampil tim Anda belum ditentukan oleh panitia.
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
                                {{-- Sebelum Anda --}}
                                @if($sebelum)
                                <tr>
                                    <td>{{ $sebelum->team->nama_tim ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sebelum->tanggal)->translatedFormat('l, d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sebelum->waktu)->format('H:i') }} WIB</td>
                                    <td>{{ $sebelum->urutan }}</td>
                                    <td><span class="badge bg-secondary">Sebelum Anda</span></td>
                                </tr>
                                @endif

                                {{-- Jadwal Anda --}}
                                <tr class="table-danger fw-bold" id="row-anda">
                                    <td>{{ $jadwal->team->nama_tim ?? Auth::user()->nama_tim }} (Anda)</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</td>
                                    <td>{{ $jadwal->urutan }}</td>
                                    <td><span class="badge bg-danger" id="status-badge">Menunggu Giliran</span></td>
                                </tr>

                                {{-- Sesudah Anda --}}
                                @if($sesudah)
                                <tr>
                                    <td>{{ $sesudah->team->nama_tim ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sesudah->tanggal)->translatedFormat('l, d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sesudah->waktu)->format('H:i') }} WIB</td>
                                    <td>{{ $sesudah->urutan }}</td>
                                    <td><span class="badge bg-warning">Setelah Anda</span></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    {{-- Countdown --}}
                    <div class="text-center mt-4">
                        <h6>Hitung Mundur Menuju Giliran Anda</h6>
                        <div id="countdown" class="fs-3 fw-bold text-danger mb-3">Memuat...</div>
                        <div id="countdown-info" class="text-muted small"></div>
                    </div>
                @endif

                <hr>

                <div class="alert alert-warning mt-3">
                    <i class="fa fa-info-circle"></i>
                    <strong>Catatan Panitia:</strong> Harap semua peserta sudah berada di area tunggu
                    <strong>30 menit</strong> sebelum jam tampil.
                </div>
            </div>
        </div>
    </div>
</div>

@if($jadwal)
@php
    $jadwalDateTime = \Carbon\Carbon::parse($jadwal->tanggal . ' ' . $jadwal->waktu, 'Asia/Jakarta');
    $serverNow = \Carbon\Carbon::now('Asia/Jakarta')->timestamp * 1000; // ms
@endphp

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    console.log("=== Script countdown dimulai ===");

    const tampilTime = {{ $jadwalDateTime->timestamp * 1000 }};
    const serverNow = {{ $serverNow }};
    const clientNow = Date.now();
    const offset = serverNow - clientNow; // selisih server vs browser

    console.log("Waktu tampil:", new Date(tampilTime).toString());
    console.log("Waktu server:", new Date(serverNow).toString());
    console.log("Offset:", offset, "ms");

    const countdownEl = document.getElementById("countdown");
    const countdownInfo = document.getElementById("countdown-info");
    const statusBadge = document.getElementById("status-badge");
    const rowAnda = document.getElementById("row-anda");

    let popup15 = false, popup10 = false, popup3 = false, popupDeg = false, popupSedang = false;

    const timer = setInterval(() => {
        const now = Date.now() + offset; // waktu server realtime
        const distance = tampilTime - now;

        // Log untuk debug
        console.log(`Distance: ${distance}ms (${Math.floor(distance / 60000)} menit)`);

        // Sebelum tampil
        if (distance > 0) {
            const hours = Math.floor(distance / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.innerHTML = hours > 0
                ? `${hours} Jam ${minutes} Menit ${seconds} Detik`
                : `${minutes} Menit ${seconds} Detik`;

            countdownEl.className = "fs-3 fw-bold text-danger mb-3";
            statusBadge.textContent = "Menunggu Giliran";
            statusBadge.className = "badge bg-danger";
            rowAnda.className = "table-danger fw-bold";

            countdownInfo.innerHTML = "Waktunya semakin dekat...";

            // === POPUP NOTIF ===
            if (distance <= 15 * 60 * 1000 && !popup15) {
                popup15 = true;
                Swal.fire("Sebentar Lagi!", "15 menit lagi giliran kamu!", "info");
            }
            if (distance <= 10 * 60 * 1000 && !popup10) {
                popup10 = true;
                Swal.fire("Ayo Bersiap!", "10 menit lagi tampil!", "warning");
            }
            if (distance <= 3 * 60 * 1000 && !popup3) {
                popup3 = true;
                Swal.fire("SEMANGAT!", "Tinggal 3 menit lagi!", "success");
            }
            if (distance <= 10 * 1000 && !popupDeg) {
                popupDeg = true;
                let degTime = 10;
                const degTimer = setInterval(() => {
                    Swal.fire({
                        title: `${degTime}`,
                        text: "Waktunya tampil hampir dimulai!",
                        timer: 900,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    degTime--;
                    if (degTime < 0) clearInterval(degTimer);
                }, 1000);
            }
        }

        // Sedang tampil (0 s.d. 30 menit setelah)
        else if (distance <= 0 && distance > -30 * 60 * 1000) {
            countdownEl.innerHTML = "Sedang Tampil";
            countdownEl.className = "fs-3 fw-bold text-primary mb-3";
            statusBadge.textContent = "Sedang Tampil";
            statusBadge.className = "badge bg-primary";
            rowAnda.className = "table-primary fw-bold";

            countdownInfo.innerHTML = "Tim kamu sedang tampil, semangat!";

            if (!popupSedang) {
                popupSedang = true;
                Swal.fire("Giliranmu!", "Sekarang tim kamu sedang tampil!", "success");
            }
        }

        // Sudah tampil (>30 menit lewat)
        else if (distance <= -30 * 60 * 1000) {
            clearInterval(timer);
            countdownEl.innerHTML = "Selesai Tampil";
            countdownEl.className = "fs-3 fw-bold text-success mb-3";
            statusBadge.textContent = "Sudah Tampil";
            statusBadge.className = "badge bg-success";
            rowAnda.className = "table-success fw-bold";

            countdownInfo.innerHTML = "Terima kasih atas partisipasinya!";

            if (!document.getElementById('cekHasilBtn')) {
                const btn = document.createElement('a');
                btn.id = "cekHasilBtn";
                btn.href = "{{ route('user.hasil') }}";
                btn.className = "btn btn-success btn-lg mt-3";
                btn.innerHTML = '<i class="fa fa-trophy"></i> Lihat Hasil Penilaian';
                countdownInfo.parentNode.appendChild(btn);
            }
        }
    }, 1000);
</script>
@endif

@endsection
