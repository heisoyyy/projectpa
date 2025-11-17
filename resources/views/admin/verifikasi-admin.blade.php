@extends('admin.komponen.komponen')

@section('title', 'Verifikasi User - Admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold">Daftar User & Status Aktivasi</h2>

    {{-- Notifikasi Pendaftar Baru Hari Ini --}}
    @if ($todayRegistrations->count() > 0)
    <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert" id="alert-pendaftar">
        <h5 class="fw-bold mb-2">Ada pendaftar baru hari ini!</h5>
        <ul class="mb-0">
            @foreach ($todayRegistrations as $reg)
            <li>
                <strong>{{ $loop->iteration }}.</strong>
                {{ $reg->nama_sekolah }}
                <span class="text-muted">({{ $reg->kota }})</span>
            </li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Flash Message --}}
    @if (session('success'))
    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif
    @if (session('info'))
    <div class="alert alert-info shadow-sm">{{ session('info') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

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
                        <th class="text-center">Aksi</th>
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
                        <td class="text-center d-flex justify-content-center gap-2">
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
                            {{-- 🌼 Tombol Edit (Modal) --}}
                            <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}">
                                <i class="bi bi-pencil"></i> Edit
                            </button>

                            {{-- 🔐 Tombol Ubah Password (Modal) --}}
                            <button class="btn btn-sm btn-info text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#passwordUserModal{{ $user->id }}">
                                <i class="bi bi-key"></i> Password
                            </button>
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.verifikasi.delete', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
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
</div>


{{-- Modal Edit User --}}
@foreach ($users as $user)
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('admin.verifikasi.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white">Edit User - {{ $user->nama_sekolah }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" value="{{ $user->nama_sekolah }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kota</label>
                        <input type="text" name="kota" value="{{ $user->kota }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                            class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endforeach
{{-- Modal Update Password --}}
@foreach ($users as $user)
<div class="modal fade" id="passwordUserModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('admin.verifikasi.updatePassword', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white">Ubah Password - {{ $user->nama_sekolah }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required minlength="6">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white">Update Password</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endforeach


{{-- ✨ Animasi alert muncul halus --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alertBox = document.getElementById('alert-pendaftar');
        if (alertBox) {
            alertBox.style.opacity = '0';
            alertBox.style.transition = 'opacity 1s ease';
            setTimeout(() => alertBox.style.opacity = '1', 200);
        }
    });
</script>

{{-- 💬 SweetAlert untuk notifikasi interaktif (hanya muncul sekali) --}}
@if ($todayRegistrations->count() > 0)
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alertKey = 'alert_pendaftar_{{ now()->format("Ymd") }}'; // unik per hari

        // Cek apakah sudah pernah ditampilkan hari ini
        if (!localStorage.getItem(alertKey)) {
            Swal.fire({
                title: '📋 Pendaftar Baru!',
                html: `
                <p class="text-start">
                    Terdapat <b>{{ $todayRegistrations->count() }}</b> pendaftar baru hari ini:
                </p>
                <ul class="text-start">
                    @foreach ($todayRegistrations as $reg)
                        <li><b>{{ $reg->nama_sekolah }}</b> <small>({{ $reg->kota }})</small></li>
                    @endforeach
                </ul>
            `,
                icon: 'info',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#3085d6',
                backdrop: true,
                timer: 7000
            }).then(() => {
                // Simpan status sudah tampil di localStorage
                localStorage.setItem(alertKey, 'shown');
            });
        }
    });
</script>
@endif

@endsection