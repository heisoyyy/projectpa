@extends('admin.komponen.komponen')
@section('title', 'Laporan Lomba')
@section('content')

<h2 class="mb-4 mt-4">Laporan Perlombaan</h2>

<div class="row mb-4">
  <div class="col-md-3"><div class="card shadow-sm text-center"><div class="card-body"><h5>Total Sekolah</h5><h3>{{ $totalSekolah ?? 0 }}</h3></div></div></div>
  <div class="col-md-3"><div class="card shadow-sm text-center"><div class="card-body"><h5>Total Jadwal</h5><h3>{{ $totalJadwal ?? 0 }}</h3></div></div></div>
  <div class="col-md-3"><div class="card shadow-sm text-center"><div class="card-body"><h5>Peserta Dinilai</h5><h3>{{ $totalDinilai ?? 0 }}</h3></div></div></div>
  <div class="col-md-3"><div class="card shadow-sm text-center"><div class="card-body"><h5>Juara 1</h5><h4>{{ $juaraSatu->nama_sekolah ?? '-' }}</h4></div></div></div>
</div>

<div class="mb-3">
  <a href="{{ route('admin.laporan.export.pdf') }}" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
  <a href="{{ route('admin.laporan.export.excel') }}" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Excel</a>
  <a href="{{ route('admin.laporan.backup') }}" class="btn btn-primary"><i class="bi bi-database"></i> Backup</a>
  <a href="{{ route('admin.laporan.reset') }}" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Hapus DB</a>
</div>

<div class="card shadow-sm">
  <div class="card-header bg-primary text-white text-center"><h5 class="mb-0">Rekap Hasil Perlombaan</h5></div>
  <div class="card-body">
    <table class="table table-bordered table-striped text-center">
      <thead class="table-primary">
        <tr><th>No</th><th>Sekolah</th><th>Total Nilai</th><th>Ranking</th><th>Aksi</th></tr>
      </thead>
      <tbody>
        @forelse($hasil as $data)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $data->nama_sekolah }}</td>
          <td>{{ number_format($data->total_nilai,2) }}</td>
          <td>{{ $data->ranking }}</td>
          <td>
            <a href="{{ route('admin.hasil-admin.detail', $data->team_id) }}" class="btn btn-sm btn-info">Detail</a>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">Belum ada data hasil</td></tr>
        @endforelse
      </tbody>
    </table>
    <p class="text-end mt-2">Dicetak pada: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i') }} WIB</p>
  </div>
</div>

@endsection
