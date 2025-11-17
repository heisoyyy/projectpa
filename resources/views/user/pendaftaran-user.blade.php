@extends('user.komponen.komponen')
@section('title','Pendaftaran Multi Tim')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">

            {{-- HEADER --}}
            <div class="bg-white rounded shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 fw-bold">
                            Kelola Tim LKBB
                        </h4>
                        <p class="text-muted mb-0">Sekolah: <strong>{{ Auth::user()->nama_sekolah }}</strong></p>
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahTim">
                        <i class="fa fa-plus"></i> Tambah Tim Baru
                    </button>
                </div>
            </div>

            {{-- DAFTAR TIM --}}
            @forelse($teams as $index => $team)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">
                                {{ $team->nama_tim }}
                            </h5>
                            <small>
                                {{ $team->peserta_count }} Peserta |
                                {{ $team->pelatih_count }} Pelatih
                            </small>
                        </div>
                        <div>
                            @if($team->status === 'verified')
                            <span class="badge bg-success">
                                <i class="fa fa-check-circle"></i> Terverifikasi
                            </span>
                            @elseif($team->status === 'rejected')
                            <span class="badge bg-danger">
                                <i class="fa fa-times-circle"></i> Ditolak
                            </span>
                            @else
                            <span class="badge bg-warning text-dark">
                                <i class="fa fa-clock"></i> Menunggu Verifikasi
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    {{-- TABEL PESERTA --}}
                    <h6 class="fw-bold mb-3">
                        Data Peserta
                    </h6>

                    <div class="table-responsive mb-4">
                        <table class="table table-hover table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Posisi</th>
                                    <th>Kartu Pelajar</th>
                                    <th>Pas Foto</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($team->members->where('role','peserta') as $no => $peserta)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $peserta->nama }}</td>
                                    <td>{{ $peserta->nis ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $peserta->posisi ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @if($peserta->dokumen_1)
                                        <a href="{{ asset('storage/'.$peserta->dokumen_1) }}"
                                            class="btn btn-sm btn-outline-secondary" target="_blank">
                                            <i class="fa fa-eye"></i> Lihat
                                        </a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($peserta->dokumen_2)
                                        <a href="{{ asset('storage/'.$peserta->dokumen_2) }}"
                                            class="btn btn-sm btn-outline-secondary" target="_blank">
                                            <i class="fa fa-image"></i> Lihat
                                        </a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($team->status !== 'verified')
                                        <button class="btn btn-sm btn-warning"
                                            onclick="editPeserta({{ $peserta->id }}, {{ $team->id }})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="hapusMember({{ $peserta->id }}, 'peserta')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @else
                                        <span class="badge bg-success">✓</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        <i class="fa fa-info-circle"></i> Belum ada peserta
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($team->status !== 'verified')
                    <button class="btn btn-sm btn-dark mb-4"
                        onclick="tambahPeserta({{ $team->id }})">
                        <i class="fa fa-plus"></i> Tambah Peserta
                    </button>
                    @endif

                    {{-- TABEL PELATIH --}}
                    <h6 class="fw-bold mb-3">
                        </i> Data Pelatih
                    </h6>

                    <div class="table-responsive mb-4">
                        <table class="table table-hover table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama Pelatih</th>
                                    <th>Nomor HP</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($team->members->where('role','pelatih') as $no => $pelatih)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $pelatih->nama }}</td>
                                    <td>{{ $pelatih->nomor_hp ?? '-' }}</td>
                                    <td>
                                        @if($team->status !== 'verified')
                                        <button class="btn btn-sm btn-warning"
                                            onclick="editPelatih({{ $pelatih->id }}, {{ $team->id }})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="hapusMember({{ $pelatih->id }}, 'pelatih')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @else
                                        <span class="badge bg-success">✓</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        <i class="fa fa-info-circle"></i> Belum ada pelatih
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($team->status !== 'verified')
                    <button class="btn btn-sm btn-dark mb-3"
                        onclick="tambahPelatih({{ $team->id }})">
                        <i class="fa fa-plus"></i> Tambah Pelatih
                    </button>
                    @endif

                    {{-- TOMBOL HAPUS TIM --}}
                    @if($team->status !== 'verified')
                    <div class="border-top pt-3 mt-3">
                        <button class="btn btn-danger btn-sm"
                            onclick="hapusTim({{ $team->id }}, '{{ $team->nama_tim }}')">
                            <i class="fa fa-trash"></i> Hapus Tim Ini
                        </button>
                    </div>
                    @endif

                </div>
            </div>
            @empty
            <div class="alert alert-info text-center">
                <i class="fa fa-info-circle fa-3x mb-3"></i>
                <h5>Belum Ada Tim Terdaftar</h5>
                <p>Klik tombol "Tambah Tim Baru" untuk mendaftarkan tim pertama Anda</p>
            </div>
            @endforelse

        </div>
    </div>
</div>

{{-- MODAL TAMBAH TIM --}}
<div class="modal fade" id="modalTambahTim" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.pendaftaran.store.team') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fa fa-plus-circle"></i> Tambah Tim Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Sekolah</label>
                        <input type="text" class="form-control bg-light"
                            value="{{ Auth::user()->nama_sekolah }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Tim <span class="text-danger">*</span></label>
                        <input type="text" name="nama_tim" class="form-control"
                            placeholder="Contoh: SMAN 1 Pekanbaru A" required>
                        <small class="text-muted">
                            Contoh: {{ Auth::user()->nama_sekolah }} A,
                            {{ Auth::user()->nama_sekolah }} B, dll
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH/EDIT PESERTA --}}
<div class="modal fade" id="modalPeserta" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formPeserta" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="peserta_method" value="POST">
                <input type="hidden" id="peserta_team_id">
                <input type="hidden" id="peserta_member_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalPesertaTitle">
                        <i class="fa fa-user-plus"></i> Tambah Peserta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Peserta <span class="text-danger">*</span></label>
                        <input type="text" id="peserta_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIS</label>
                        <input type="text" id="peserta_nis" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Posisi <span class="text-danger">*</span></label>
                        <select id="peserta_posisi" class="form-select" required>
                            <option value="">-- Pilih Posisi --</option>
                            <option value="Danton">Danton</option>
                            <option value="Anggota">Anggota</option>
                            <option value="Cadangan">Cadangan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kartu Pelajar</label>
                        <div id="peserta_dok1_preview"></div>
                        <input type="file" id="peserta_dok1" class="form-control" accept="image/*,.pdf">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pas Foto</label>
                        <div id="peserta_dok2_preview"></div>
                        <input type="file" id="peserta_dok2" class="form-control" accept="image/*,.pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH/EDIT PELATIH --}}
<div class="modal fade" id="modalPelatih" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formPelatih" method="POST">
                @csrf
                <input type="hidden" name="_method" id="pelatih_method" value="POST">
                <input type="hidden" id="pelatih_team_id">
                <input type="hidden" id="pelatih_member_id">

                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalPelatihTitle">
                        <i class="fa fa-user-plus"></i> Tambah Pelatih
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pelatih <span class="text-danger">*</span></label>
                        <input type="text" id="pelatih_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor HP</label>
                        <input type="text" id="pelatih_hp" class="form-control" maxlength="15">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Data teams dari server
    const teamsData = @json($teams);

    // ==================== PESERTA ====================
    function tambahPeserta(teamId) {
        document.getElementById('modalPesertaTitle').innerHTML = '<i class="fa fa-user-plus"></i> Tambah Peserta';
        document.getElementById('peserta_method').value = 'POST';
        document.getElementById('peserta_team_id').value = teamId;
        document.getElementById('peserta_member_id').value = '';

        // Reset form
        document.getElementById('peserta_nama').value = '';
        document.getElementById('peserta_nis').value = '';
        document.getElementById('peserta_posisi').value = '';
        document.getElementById('peserta_dok1').value = '';
        document.getElementById('peserta_dok2').value = '';
        document.getElementById('peserta_dok1_preview').innerHTML = '';
        document.getElementById('peserta_dok2_preview').innerHTML = '';

        document.getElementById('formPeserta').action = `/user/pendaftaran/${teamId}/members`;
        new bootstrap.Modal(document.getElementById('modalPeserta')).show();
    }

    function editPeserta(memberId, teamId) {
        const team = teamsData.find(t => t.id === teamId);
        const peserta = team.members.find(m => m.id === memberId);

        document.getElementById('modalPesertaTitle').innerHTML = '<i class="fa fa-edit"></i> Edit Peserta';
        document.getElementById('peserta_method').value = 'PUT';
        document.getElementById('peserta_team_id').value = teamId;
        document.getElementById('peserta_member_id').value = memberId;

        document.getElementById('peserta_nama').value = peserta.nama || '';
        document.getElementById('peserta_nis').value = peserta.nis || '';
        document.getElementById('peserta_posisi').value = peserta.posisi || '';

        // Preview dokumen
        document.getElementById('peserta_dok1_preview').innerHTML = peserta.dokumen_1 ?
            `<a href="/storage/${peserta.dokumen_1}" target="_blank" class="btn btn-sm btn-info mb-2">Lihat Dokumen Saat Ini</a>` :
            '';
        document.getElementById('peserta_dok2_preview').innerHTML = peserta.dokumen_2 ?
            `<a href="/storage/${peserta.dokumen_2}" target="_blank" class="btn btn-sm btn-info mb-2">Lihat Foto Saat Ini</a>` :
            '';

        document.getElementById('formPeserta').action = `/user/pendaftaran/${teamId}/members`;
        new bootstrap.Modal(document.getElementById('modalPeserta')).show();
    }

    document.getElementById('formPeserta').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData();
        const teamId = document.getElementById('peserta_team_id').value;
        const memberId = document.getElementById('peserta_member_id').value;
        const method = document.getElementById('peserta_method').value;
        const key = memberId || 'new_' + Date.now();

        formData.append('_token', '{{ csrf_token() }}');
        if (method === 'PUT') formData.append('_method', 'PUT');

        formData.append(`peserta[${key}][nama]`, document.getElementById('peserta_nama').value);
        formData.append(`peserta[${key}][nis]`, document.getElementById('peserta_nis').value);
        formData.append(`peserta[${key}][posisi]`, document.getElementById('peserta_posisi').value);

        const file1 = document.getElementById('peserta_dok1').files[0];
        const file2 = document.getElementById('peserta_dok2').files[0];
        if (file1) formData.append(`peserta[${key}][dokumen_1]`, file1);
        if (file2) formData.append(`peserta[${key}][dokumen_2]`, file2);

        fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire('Berhasil!', 'Data peserta berhasil disimpan', 'success')
                    .then(() => location.reload());
            })
            .catch(err => {
                Swal.fire('Error', 'Gagal menyimpan data', 'error');
            });
    });

    // ==================== PELATIH ====================
    function tambahPelatih(teamId) {
        document.getElementById('modalPelatihTitle').innerHTML = '<i class="fa fa-user-plus"></i> Tambah Pelatih';
        document.getElementById('pelatih_method').value = 'POST';
        document.getElementById('pelatih_team_id').value = teamId;
        document.getElementById('pelatih_member_id').value = '';

        document.getElementById('pelatih_nama').value = '';
        document.getElementById('pelatih_hp').value = '';

        document.getElementById('formPelatih').action = `/user/pendaftaran/${teamId}/members`;
        new bootstrap.Modal(document.getElementById('modalPelatih')).show();
    }

    function editPelatih(memberId, teamId) {
        const team = teamsData.find(t => t.id === teamId);
        const pelatih = team.members.find(m => m.id === memberId);

        document.getElementById('modalPelatihTitle').innerHTML = '<i class="fa fa-edit"></i> Edit Pelatih';
        document.getElementById('pelatih_method').value = 'PUT';
        document.getElementById('pelatih_team_id').value = teamId;
        document.getElementById('pelatih_member_id').value = memberId;

        document.getElementById('pelatih_nama').value = pelatih.nama || '';
        document.getElementById('pelatih_hp').value = pelatih.nomor_hp || '';

        document.getElementById('formPelatih').action = `/user/pendaftaran/${teamId}/members`;
        new bootstrap.Modal(document.getElementById('modalPelatih')).show();
    }

    document.getElementById('formPelatih').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData();
        const teamId = document.getElementById('pelatih_team_id').value;
        const memberId = document.getElementById('pelatih_member_id').value;
        const method = document.getElementById('pelatih_method').value;
        const key = memberId || 'new_' + Date.now();

        formData.append('_token', '{{ csrf_token() }}');
        if (method === 'PUT') formData.append('_method', 'PUT');

        formData.append(`pelatih[${key}][nama]`, document.getElementById('pelatih_nama').value);
        formData.append(`pelatih[${key}][nomor_hp]`, document.getElementById('pelatih_hp').value);

        fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire('Berhasil!', 'Data pelatih berhasil disimpan', 'success')
                    .then(() => location.reload());
            })
            .catch(err => {
                Swal.fire('Error', 'Gagal menyimpan data', 'error');
            });
    });

    // ==================== HAPUS ====================
    function hapusMember(memberId, role) {
        Swal.fire({
            title: `Hapus ${role === 'peserta' ? 'Peserta' : 'Pelatih'}?`,
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/user/pendaftaran/member/${memberId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire('Terhapus!', 'Data berhasil dihapus', 'success')
                            .then(() => location.reload());
                    });
            }
        });
    }

    function hapusTim(teamId, namaTim) {
        Swal.fire({
            title: 'Hapus Tim?',
            html: `Tim <strong>${namaTim}</strong> dan semua anggotanya akan dihapus!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/user/pendaftaran/team/${teamId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire('Terhapus!', 'Tim berhasil dihapus', 'success')
                            .then(() => location.reload());
                    });
            }
        });
    }
</script>

@endsection