@extends('admin.komponen.komponen')

@section('title', 'Kelola Informasi')

@section('content')
<div class="container py-4  mt-2">
    <h2 class="mb-4">Kelola Informasi LKBB Komando</h2>

    <!-- Hero Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-bold bg-dark text-white">Background</div>
        <div class="card-body">
            <form action="{{ route('admin.kelola-informasi.hero') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Halaman</label>
                    <input type="text" name="title" class="form-control" value="{{ $informasi->title ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="3" class="form-control">{{ $informasi->description ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Background Hero</label>
                    <input type="file" name="background" class="form-control">
                    @if($informasi->background)
                    <img src="{{ Storage::url($informasi->background) }}" width="150" class="mt-2 rounded">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan Hero</button>
            </form>
        </div>
    </div>

    <!-- Biodata Kepala Sekolah & Ketua OSIS -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-bold bg-dark text-white">Biodata Kepala Sekolah & Ketua OSIS</div>
        <div class="card-body row">
            @foreach($biodata as $bio)
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm p-3 text-center">
                    <h5>{{ $loop->first ? 'Kepala Sekolah' : 'Ketua OSIS' }}</h5>
                    @if($bio->foto)
                    <img src="{{ Storage::url($bio->foto) }}" width="120" class="rounded mb-2" alt="{{ $bio->nama }}">
                    @endif
                    <p><strong>{{ $bio->nama }}</strong></p>
                    <p>{{ $bio->deskripsi }}</p>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateBiodata{{ $bio->id }}">
                        Update
                    </button>
                </div>
            </div>

            <!-- Modal Update Biodata -->
            <div class="modal fade" id="updateBiodata{{ $bio->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-white">
                        <div class="modal-header">
                            <h5 class="modal-title">Update {{ $loop->first ? 'Kepala Sekolah' : 'Ketua OSIS' }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('admin.kelola-informasi.biodata', $bio->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $bio->nama }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" value="{{ $bio->deskripsi }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-warning" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Dokumen Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-bold bg-dark text-white">Dokumen & Panduan</div>
        <div class="card-body">
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDokumenModal">Tambah Dokumen</button>

            <!-- Modal Tambah Dokumen -->
            <div class="modal fade" id="addDokumenModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content bg-white">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Dokumen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('admin.kelola-informasi.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="text" name="judul" class="form-control mb-2" placeholder="Judul Dokumen" required>
                                <input type="file" name="thumbnail" class="form-control mb-2">
                                <input type="file" name="file" class="form-control mb-2" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List Dokumen -->
            <table class="table table-bordered table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokumen as $doc)
                    <tr>
                        <td>@if($doc->thumbnail)<img src="{{ Storage::url($doc->thumbnail) }}" width="50">@endif</td>
                        <td>{{ $doc->judul }}</td>
                        <td>@if($doc->file)<a href="{{ Storage::url($doc->file) }}" target="_blank">Download</a>@endif</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateDokumen{{ $doc->id }}">Update</button>
                            <form action="{{ route('admin.kelola-informasi.dokumen.delete', $doc->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Update Dokumen -->
                    <div class="modal fade" id="updateDokumen{{ $doc->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Dokumen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.kelola-informasi.dokumen.update', $doc->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="text" name="judul" class="form-control mb-2" value="{{ $doc->judul }}" required>
                                        <input type="file" name="thumbnail" class="form-control mb-2">
                                        <input type="file" name="file" class="form-control mb-2">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- History Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-bold bg-dark text-white">Daftar Sekolah</div>
        <div class="card-body">
            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addHistoryModal">
                + Tambah Sekolah
            </button>

            <!-- Modal Tambah History -->
            <div class="modal fade" id="addHistoryModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content bg-white">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Sekolah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('admin.kelola-informasi.history.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
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
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" name="kota" id="kota" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- List History -->
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th width="80">Foto</th>
                        <th>Sekolah</th>
                        <th width="120">Kota</th>
                        <th>Deskripsi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $h)
                    <tr>
                        <td>
                            @if($h->image)
                            <img src="{{ Storage::url($h->image) }}" width="70" class="rounded">
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $h->nama_sekolah }}</td>
                        <td>{{ $h->kota }}</td>
                        <td>{{ $h->deskripsi }}</td>
                        <td>
                            <!-- Tombol Update -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateHistory{{ $h->id }}">
                                Update
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.kelola-informasi.history.delete', $h->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Update History -->
                    <div class="modal fade" id="updateHistory{{ $h->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Sekolah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.kelola-informasi.history.update', $h->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_sekolah{{ $h->id }}" class="form-label">Nama Sekolah</label>
                                            <select name="nama_sekolah" id="nama_sekolah{{ $h->id }}" class="form-select" onchange="updateKota(this)">
                                                @foreach($sekolahs as $s)
                                                <option value="{{ $s->nama_sekolah }}" data-kota="{{ $s->kota }}"
                                                    @if($h->nama_sekolah == $s->nama_sekolah) selected @endif>
                                                    {{ $s->nama_sekolah }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="kota{{ $h->id }}" class="form-label">Kota</label>
                                            <input type="text" name="kota" id="kota{{ $h->id }}" class="form-control" value="{{ $h->kota }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi{{ $h->id }}" class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi{{ $h->id }}" class="form-control">{{ $h->deskripsi }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="image{{ $h->id }}" class="form-label">Gambar</label>
                                            <input type="file" name="image" id="image{{ $h->id }}" class="form-control">
                                            @if($h->image)
                                            <img src="{{ Storage::url($h->image) }}" width="100" class="mt-2 rounded">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data history</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $history->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>
@endsection