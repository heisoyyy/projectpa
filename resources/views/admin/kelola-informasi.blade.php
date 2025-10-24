@extends('admin.komponen.komponen')

@section('title', 'Kelola Informasi')

@section('content')
<div class="container-fluid  mb-4 mt-4">

    {{-- Page Header --}}
    <div class="card border-0 shadow-sm mb-4 bg-dark text-white">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">Kelola Informasi LKBB Komando</h3>
                            <p class="mb-0 opacity-75">Kelola hero, biodata, dokumen, dan daftar sekolah</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <small class="d-flex align-items-center justify-content-md-end">
                        <i class="bi bi-clock me-2"></i>
                        {{ now()->format('d M Y, H:i') }} WIB
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- 🎨 Hero Section --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white border-0 py-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold">Background Hero</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.kelola-informasi.hero') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-type text-muted me-1"></i> Judul Halaman
                                </label>
                                <input type="text" name="title" class="form-control form-control-lg"
                                    value="{{ $informasi->title ?? '' }}"
                                    placeholder="Masukkan judul halaman">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-card-image text-muted me-1"></i> Background Hero
                                </label>
                                <input type="file" name="background" class="form-control form-control-lg">
                                @if($informasi->background)
                                <div class="mt-3">
                                    <img src="{{ Storage::url($informasi->background) }}"
                                        class="img-thumbnail"
                                        style="max-width: 200px; height: auto;">
                                </div>
                                @endif
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-text-paragraph text-muted me-1"></i> Deskripsi
                                </label>
                                <textarea name="description" rows="3" class="form-control"
                                    placeholder="Masukkan deskripsi halaman">{{ $informasi->description ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-dark btn-lg shadow-sm">
                                <i class="bi bi-save me-2"></i> Simpan Hero
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 👥 Biodata Section --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 fw-bold">Biodata Kepala Sekolah & Ketua OSIS</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        @foreach($biodata as $bio)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <span class="badge bg-info mb-3">
                                            {{ $loop->first ? 'Kepala Sekolah' : 'Ketua OSIS' }}
                                        </span>
                                    </div>

                                    @if($bio->foto)
                                    <div class="mb-3">
                                        <img src="{{ Storage::url($bio->foto) }}"
                                            class="rounded-circle border border-3 border-info"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    @else
                                    <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                        <i class="bi bi-person-fill fs-1 text-muted"></i>
                                    </div>
                                    @endif

                                    <h5 class="fw-bold mb-2">{{ $bio->nama }}</h5>
                                    <p class="text-muted mb-4">{{ $bio->deskripsi }}</p>

                                    <button type="button" class="btn btn-warning shadow-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateBiodata{{ $bio->id }}">
                                        <i class="bi bi-pencil-square me-1"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Update Biodata --}}
                        <div class="modal fade" id="updateBiodata{{ $bio->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-warning bg-opacity-10 border-0">
                                        <h5 class="modal-title fw-bold">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Update {{ $loop->first ? 'Kepala Sekolah' : 'Ketua OSIS' }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.kelola-informasi.biodata', $bio->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Foto</label>
                                                <input type="file" name="foto" class="form-control">
                                                @if($bio->foto)
                                                <div class="mt-2">
                                                    <img src="{{ Storage::url($bio->foto) }}"
                                                        class="img-thumbnail"
                                                        style="max-width: 100px;">
                                                </div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Nama</label>
                                                <input type="text" name="nama" class="form-control" value="{{ $bio->nama }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Deskripsi</label>
                                                <input type="text" name="deskripsi" class="form-control" value="{{ $bio->deskripsi }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                                <i class="bi bi-x-circle me-1"></i> Batal
                                            </button>
                                            <button class="btn btn-warning" type="submit">
                                                <i class="bi bi-save me-1"></i> Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- 📄 Dokumen Section --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 fw-bold">Dokumen & Panduan</h5>
                        </div>
                        <button type="button" class="btn btn-success shadow-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#addDokumenModal">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Dokumen
                        </button>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="100">Thumbnail</th>
                                    <th>Judul</th>
                                    <th width="150">File</th>
                                    <th width="200" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dokumen as $doc)
                                <tr>
                                    <td>
                                        @if($doc->thumbnail)
                                        <img src="{{ Storage::url($doc->thumbnail) }}"
                                            class="img-thumbnail"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="bi bi-file-earmark fs-4 text-muted"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-semibold">{{ $doc->judul }}</p>
                                    </td>
                                    <td>
                                        @if($doc->file)
                                        <a href="{{ Storage::url($doc->file) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-download me-1"></i> Download
                                        </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#updateDokumen{{ $doc->id }}">
                                            <i class="bi bi-pencil me-1"></i> Update
                                        </button>
                                        <form action="{{ route('admin.kelola-informasi.dokumen.delete', $doc->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Update Dokumen --}}
                                <div class="modal fade" id="updateDokumen{{ $doc->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-warning bg-opacity-10 border-0">
                                                <h5 class="modal-title fw-bold">
                                                    <i class="bi bi-pencil-square me-2"></i> Update Dokumen
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.kelola-informasi.dokumen.update', $doc->id) }}"
                                                method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body p-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Judul Dokumen</label>
                                                        <input type="text" name="judul" class="form-control"
                                                            value="{{ $doc->judul }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Thumbnail</label>
                                                        <input type="file" name="thumbnail" class="form-control">
                                                        @if($doc->thumbnail)
                                                        <div class="mt-2">
                                                            <img src="{{ Storage::url($doc->thumbnail) }}"
                                                                class="img-thumbnail"
                                                                style="max-width: 100px;">
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">File Dokumen</label>
                                                        <input type="file" name="file" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="bi bi-x-circle me-1"></i> Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="bi bi-save me-1"></i> Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        Belum ada dokumen
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Tambah Dokumen --}}
        <div class="modal fade" id="addDokumenModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-success bg-opacity-10 border-0">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Dokumen
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.kelola-informasi.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul Dokumen</label>
                                <input type="text" name="judul" class="form-control"
                                    placeholder="Masukkan judul dokumen" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Thumbnail (opsional)</label>
                                <input type="file" name="thumbnail" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">File Dokumen</label>
                                <input type="file" name="file" class="form-control" required>
                                <small class="text-muted">Unggah file dokumen (PDF, DOCX, dll).</small>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 🏫 Daftar Sekolah --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 fw-bold">Daftar Sekolah Peserta</h5>
                        </div>
                        <button type="button" class="btn btn-primary shadow-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#addHistoryModal">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Sekolah
                        </button>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="100">Foto</th>
                                    <th>Sekolah</th>
                                    <th width="150">Kota</th>
                                    <th>Deskripsi</th>
                                    <th width="200" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($history as $h)
                                <tr>
                                    <td>
                                        @if($h->image)
                                        <img src="{{ Storage::url($h->image) }}"
                                            class="rounded"
                                            style="width: 70px; height: 70px; object-fit: cover;">
                                        @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width: 70px; height: 70px;">
                                            <i class="bi bi-building fs-4 text-muted"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-semibold">{{ $h->nama_sekolah }}</p>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $h->kota }}</span>
                                    </td>
                                    <td>{{ $h->deskripsi }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#updateHistory{{ $h->id }}">
                                            <i class="bi bi-pencil me-1"></i> Update
                                        </button>
                                        <form action="{{ route('admin.kelola-informasi.history.delete', $h->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Update History --}}
                                <div class="modal fade" id="updateHistory{{ $h->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-warning bg-opacity-10 border-0">
                                                <h5 class="modal-title fw-bold">
                                                    <i class="bi bi-pencil-square me-2"></i> Update Sekolah
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.kelola-informasi.history.update', $h->id) }}"
                                                method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body p-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Nama Sekolah</label>
                                                        <select name="nama_sekolah" class="form-select" onchange="updateKotaEdit(this, '{{ $h->id }}')">
                                                            @foreach($sekolahs as $s)
                                                            <option value="{{ $s->nama_sekolah }}"
                                                                data-kota="{{ $s->kota }}"
                                                                @if($h->nama_sekolah == $s->nama_sekolah) selected @endif>
                                                                {{ $s->nama_sekolah }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Kota</label>
                                                        <input type="text" name="kota" id="kota_edit_{{ $h->id }}"
                                                            class="form-control" value="{{ $h->kota }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" rows="3">{{ $h->deskripsi }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Gambar</label>
                                                        <input type="file" name="image" class="form-control">
                                                        @if($h->image)
                                                        <div class="mt-2">
                                                            <img src="{{ Storage::url($h->image) }}"
                                                                class="img-thumbnail"
                                                                style="max-width: 100px;">
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="bi bi-x-circle me-1"></i> Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="bi bi-save me-1"></i> Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        Belum ada data sekolah
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($history->hasPages())
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $history->links('pagination::bootstrap-5') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Modal Tambah Sekolah --}}
        <div class="modal fade" id="addHistoryModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary bg-opacity-10 border-0">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Sekolah
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.kelola-informasi.history.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Sekolah</label>
                                <select name="nama_sekolah" id="nama_sekolah" class="form-select" onchange="updateKota(this)" required>
                                    <option value="">-- Pilih Sekolah --</option>
                                    @foreach($sekolahs as $s)
                                    <option value="{{ $s->nama_sekolah }}" data-kota="{{ $s->kota }}">
                                        {{ $s->nama_sekolah }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kota</label>
                                <input type="text" name="kota" id="kota" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi sekolah"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Gambar</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> {{-- end row --}}

</div>
@endsection
<script>
// Function untuk update kota saat tambah sekolah
function updateKota(select) {
    const selectedOption = select.options[select.selectedIndex];
    const kota = selectedOption.getAttribute('data-kota');
    document.getElementById('kota').value = kota || '';
}

// Function untuk update kota saat edit sekolah
function updateKotaEdit(select, id) {
    const selectedOption = select.options[select.selectedIndex];
    const kota = selectedOption.getAttribute('data-kota');
    document.getElementById('kota_edit_' + id).value = kota || '';
}
</script>