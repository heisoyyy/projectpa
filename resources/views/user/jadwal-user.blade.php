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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const tampilTime = new Date("{{ $jadwal->tanggal }} {{ $jadwal->waktu }}").getTime();
    const countdownEl = document.getElementById("countdown");

    const tableRow = document.querySelector('tr.table-primary');
    const statusTd = tableRow.querySelector('td:nth-child(5) span.badge');

    const timer = setInterval(() => {
        const now = new Date().getTime();
        const distance = tampilTime - now;

        // countdown default
        if (distance > 0) {
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            countdownEl.innerHTML = `${hours}:${minutes}:${seconds}`;
        }

        // 15 menit sebelum tampil
        if (distance <= 15 * 60 * 1000 && distance > 0) {
            countdownEl.innerHTML = `Bersiap! ${Math.floor(distance / (1000 * 60))}m ${Math.floor((distance % (1000 * 60)) / 1000)}s lagi`;
            countdownEl.classList.remove("text-success");
            countdownEl.classList.add("text-danger");
        }

        // Sedang tampil
        else if (distance <= 0 && distance > -30 * 60 * 1000) {
            countdownEl.innerHTML = "Sedang Tampil";
            countdownEl.classList.remove("text-danger");
            countdownEl.classList.add("text-primary");
            statusTd.textContent = "Sedang Tampil";
            statusTd.className = "badge bg-primary";
        }

        // Sudah tampil
        else if (distance <= -30 * 60 * 1000) {
            clearInterval(timer);
            countdownEl.innerHTML = "Selesai Tampil";
            countdownEl.classList.remove("text-primary");
            countdownEl.classList.add("text-success");
            statusTd.textContent = "Sudah Tampil";
            statusTd.className = "badge bg-success";

            if (!document.getElementById('cekHasilBtn')) {
                const resultBtn = document.createElement('a');
                resultBtn.id = "cekHasilBtn";
                resultBtn.href = "{{ route('user.hasil') }}";
                resultBtn.className = "btn btn-success btn-sm mt-2";
                resultBtn.textContent = "Lihat Hasil";
                countdownEl.parentNode.appendChild(resultBtn);
            }
        }
    }, 1000);

    // === Popup Reminder ===
    const notifTimer = setInterval(() => {
        const now = new Date().getTime();
        const distance = tampilTime - now;

        if (distance <= 10 * 60 * 1000 && distance > 9 * 60 * 1000) {
            Swal.fire({
                icon: 'info',
                title: '10 Menit Lagi!',
                text: 'Giliran tampil tim {{ $jadwal->team->nama_sekolah ?? "Anda" }} akan dimulai!',
                timer: 4000,
                showConfirmButton: false
            });
        }
        if (distance <= 1 * 60 * 1000 && distance > 59 * 1000) {
            Swal.fire({
                icon: 'warning',
                title: '1 Menit Lagi!',
                text: 'Bersiaplah, giliran tampil segera dimulai!',
                timer: 4000,
                showConfirmButton: false
            });
        }
        if (distance <= 0 && distance > -20 * 60 * 1000) {
            Swal.fire({
                icon: 'success',
                title: 'Giliran Anda!',
                text: 'Sekarang tim Anda sedang tampil!',
                timer: 6000,
                showConfirmButton: false
            });
            clearInterval(notifTimer);
        }
    }, 1000);
</script>
@endif

@endsection