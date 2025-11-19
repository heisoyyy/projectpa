@extends('juri.komponen.komponen')

@section('title', 'Tim Sekolah')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4">Daftar Tim Peserta Sekolah</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Tim Sekolah</th>
                        <th>Jumlah Pelatih</th>
                        <th>Jumlah Peserta</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($teams as $i => $team)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $team->nama_tim }}</td>
                        <td>{{ $team->pelatih_count  }}</td>
                        <td>{{ $team->peserta_count  }}</td>
                        <td>
                            @if($team->status == 'pending')
                            <span class="badge bg-warning">Belum Diverifikasi</span>
                            @else
                            <span class="badge bg-success">Terverifikasi</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('juri/detail-sekolah/'.$team->id) }}" class="btn btn-sm btn-info">Cek</a>  
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada sekolah yang mendaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection