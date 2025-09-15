@extends('.admin.komponen.admin-komponen')
@section('title', 'Detail Tim')
@section('content')

<h3 class="mb-4">Detail Tim: {{ $team->user->nama_sekolah ?? '-' }}</h3>

<div class="card mb-3">
    <div class="card-body">
        <p><strong>Nama Sekolah:</strong> {{ $team->user->nama_sekolah ?? '-' }}</p>
        <p><strong>Total Nilai (Rata-rata):</strong> {{ number_format($total_nilai, 2) }}</p>
        <p><strong>Ranking:</strong> {{ $ranking }}</p>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Anggota Tim</h5>
    </div>
    <div class="card-body">
        <ul>
            @foreach($team->users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Hasil Penilaian</h5>
    </div>
    <div class="card-body">
        @if($hasil->isEmpty())
            <p>Belum ada nilai untuk tim ini.</p>
        @else
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nilai Baris</th>
                        <th>Nilai Variasi</th>
                        <th>Nilai Formasi</th>
                        <th>Nilai Kompak</th>
                        <th>Total</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasil as $index => $h)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $h->nilai_baris }}</td>
                        <td>{{ $h->nilai_variasi }}</td>
                        <td>{{ $h->nilai_formasi }}</td>
                        <td>{{ $h->nilai_kompak }}</td>
                        <td>{{ number_format($h->total, 2) }}</td>
                        <td>{{ $h->catatan ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<p class="text-end mt-2">Dicetak pada: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i') }} WIB</p>

@endsection
