@extends('admin.komponen.komponen')

@section('title', 'Setting Admin')

@section('content')

<h3 class="mb-4">Pengaturan Akun & Sistem</h3>

<div class="row">

    <!-- Ganti Password -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Ubah Password</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control">
                    </div>
                    <button type="button" class="btn btn-warning">Simpan Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Pengaturan Notifikasi</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="notifEmail" checked>
                        <label class="form-check-label" for="notifEmail">
                            Kirim notifikasi ke email
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="notifDashboard" checked>
                        <label class="form-check-label" for="notifDashboard">
                            Tampilkan notifikasi di dashboard
                        </label>
                    </div>
                    <button type="button" class="btn btn-info text-white">Simpan Notifikasi</button>
                </form>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <!-- Backup Database -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Backup Database</h5>
            </div>
            <div class="card-body">
                <p>Download backup database dalam format <strong>SQL</strong>.</p>
                <button type="button" class="btn btn-success">
                    <i class="bi bi-download"></i> Backup Sekarang
                </button>
            </div>
        </div>
    </div>

    <!-- Reset / Hapus Database -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Reset Database</h5>
            </div>
            <div class="card-body">
                <p class="text-danger">⚠️ Tindakan ini akan menghapus semua data peserta, jadwal, dan hasil perlombaan.</p>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusDBModal">
                    <i class="bi bi-trash"></i> Hapus Database
                </button>
            </div>
        </div>
    </div>

</div>

<!-- Modal Konfirmasi Hapus DB -->
<div class="modal fade" id="hapusDBModal" tabindex="-1" aria-labelledby="hapusDBLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="hapusDBLabel">Konfirmasi Hapus Database</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin <strong>menghapus seluruh database</strong>?<br>
                Data yang dihapus tidak bisa dikembalikan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Ya, Hapus Database</button>
            </div>
        </div>
    </div>
</div>

@endsection