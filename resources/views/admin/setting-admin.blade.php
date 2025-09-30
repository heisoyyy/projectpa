@extends('admin.komponen.komponen')

@section('title', 'Pengaturan Admin')

@section('content')

<div class="container-fluid">

    {{-- 🔔 Flash Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold mb-0">⚙️ Pengaturan Akun & Sistem</h3>
        <small class="text-muted">Terakhir diperbarui: {{ now()->format('d-m-Y H:i') }}</small>
    </div>

    <div class="row g-4">

        {{-- 🟡 Ganti Password --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-warning text-dark fw-semibold">
                    <i class="bi bi-key me-1"></i> Ubah Password
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Password Lama</label>
                            <input type="password" name="password_lama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_baru_confirmation" class="form-control" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> {{-- end row --}}
</div>

@endsection