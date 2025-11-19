@extends('juri.komponen.komponen')

@section('title', 'Peserta Sekolah')

@section('content')

<h2 class="mb-4 mt-4">Daftar User & Status Aktivasi</h2>

{{-- Tabel --}}
<div class="card shadow-sm border-0">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Nama Sekolah</th>
                    <th>Kota</th>
                    <th>Status Verifikasi</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nama_sekolah }}</td>
                    <td>{{ $user->kota }}</td>
                    <td>
                        @if ($user->is_verified)
                        <span class="badge bg-success">Terverifikasi</span>
                        @else
                        <span class="badge bg-danger">Belum Verifikasi</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada user terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection