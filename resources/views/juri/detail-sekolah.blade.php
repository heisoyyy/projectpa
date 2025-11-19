@extends('juri.komponen.komponen')

@section('title', 'Detail Sekolah')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Detail Pendaftaran Tim- {{ $team->nama_tim }}</h2>

    {{-- Info Sekolah --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Data Tim Sekolah</h5>
            <p><strong>Nama Tim:</strong> {{ $team->nama_tim }}</p>
            <p><strong>Alamat:</strong> {{ $team->user->kota ?? '-' }}</p>
            <p><strong>Status:</strong>
                @if($team->status == 'pending')
                <span class="badge bg-warning">Belum Diverifikasi</span>
                @elseif($team->status == 'verified')
                <span class="badge bg-success">Terverifikasi</span>
                @else
                <span class="badge bg-danger">Perlu Perbaikan</span>
                @endif
            </p>
        </div>
    </div>

    {{-- Data Peserta --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Daftar Peserta</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>NIS</th>
                        <th>Kartu Pelajar</th>
                        <th>Pas Photo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($team->members->where('role','peserta')->values() as $i => $peserta)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ ucfirst($peserta->posisi) }}</td>
                        <td>{{ $peserta->nis }}</td>
                        <td>
                            @if($peserta->dokumen_1)
                            <a href="{{ asset('storage/'.$peserta->dokumen_1) }}" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($peserta->dokumen_2)
                            <a href="{{ asset('storage/'.$peserta->dokumen_2) }}" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada peserta</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Data Pelatih --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Data Pelatih</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No HP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($team->members->where('role','pelatih')->values() as $i => $pelatih)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $pelatih->nama }}</td>
                        <td>{{ $pelatih->nomor_hp ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada pelatih</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol Verifikasi + Back --}}
    <div class="d-flex gap-2">
        {{-- Tombol Back (pisah dari form) --}}
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">⬅ Kembali</button>
    </div>
</div>

<script>
    window.addEventListener("pageshow", function(event) {
        if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
            location.reload();
        }
    });
</script>
@endsection