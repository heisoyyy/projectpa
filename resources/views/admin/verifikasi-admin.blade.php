@extends('admin.komponen.komponen')

@section('title', 'Verifikasi User - Admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar User & Status Verifikasi</h2>

    {{-- Flash Message --}}
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Nama Sekolah</th>
                        <th>Kota</th>
                        <th>Status Verifikasi</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
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
                        <td>
                            @if (!$user->is_verified)
                            <form action="{{ route('admin.verifikasi.verify', $user->id) }}" method="POST" onsubmit="return confirm('Yakin verifikasi user ini?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Verifikasi Manual
                                </button>
                            </form>
                            @else
                            <button class="btn btn-sm btn-success" disabled>Sudah Diverifikasi</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada user terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection