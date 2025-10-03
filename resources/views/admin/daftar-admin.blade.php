@extends('admin.komponen.komponen')

@section('title', 'Daftar Admin')
@section('content')
<div class="container-fluid text-center mt-4">
    <h2 class="mb-4">Daftar Peserta Sekolah</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Sekolah</th>
                        <th>Jumlah Peserta</th>
                        <th>Status</th>
                        <th>Surat Izin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($teams as $i => $team)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $team->nama_tim }}</td>
                        <td>{{ $team->members_count }}</td>
                        <td>
                            @if($team->status == 'pending')
                            <span class="badge bg-warning">Belum Diverifikasi</span>
                            @else
                            <span class="badge bg-success">Terverifikasi</span>
                            @endif
                        </td>
                        <td>
                            @if($team->user && $team->user->foto_surat_izin)
                            <a href="{{ asset('storage/'.$team->user->foto_surat_izin) }}" class="btn btn-sm btn-primary" target="_blank">Lihat Surat</a>
                            @else
                            <span class="text-muted">Tidak ada surat</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/detail-sekolah/'.$team->id) }}" class="btn btn-sm btn-info">Cek</a>
                            @if($team->status == 'pending')
                            <form action="{{ route('admin.verifikasi', $team->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" name="status" value="verified" class="btn btn-sm btn-success">Verifikasi</button>
                            </form>
                            @else
                            <button class="btn btn-sm btn-secondary" disabled>Sudah</button>
                            @endif
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