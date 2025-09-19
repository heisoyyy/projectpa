@extends('admin.komponen.komponen')

@section('title', 'Kelola Homepage')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Kelola Homepage</h3>

    {{-- ===== Banner ===== --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Banner Slider</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBanner">+ Tambah Banner</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Sub Judul</th>
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr>
                        <td>{{ $banner->judul }}</td>
                        <td>{{ $banner->sub_judul }}</td>
                        <td>{{ $banner->kategori }}</td>
                        <td><img src="{{ asset('storage/'.$banner->gambar) }}" width="120"></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditBanner{{ $banner->id }}">Edit</button>
                            <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus banner ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit Banner --}}
                    <div class="modal fade" id="modalEditBanner{{ $banner->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Banner</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="judul" value="{{ $banner->judul }}" class="form-control mb-2" placeholder="Judul">
                                        <input type="text" name="sub_judul" value="{{ $banner->sub_judul }}" class="form-control mb-2" placeholder="Sub Judul">
                                        <input type="text" name="kategori" value="{{ $banner->kategori }}" class="form-control mb-2" placeholder="Kategori">
                                        <span> Gambar </span>
                                        <input type="file" name="gambar" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
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

    {{-- Modal Tambah Banner --}}
    <div class="modal fade" id="modalTambahBanner" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="judul" class="form-control mb-2" placeholder="Judul">
                        <input type="text" name="sub_judul" class="form-control mb-2" placeholder="Sub Judul">
                        <input type="text" name="kategori" class="form-control mb-2" placeholder="Kategori">
                        <span> Gambar </span>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== Featured + Accordion ===== --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Featured Section</h5>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditFeatured">Edit Featured</button>
        </div>
        <div class="card-body">
            <div class="mb-3">
                @if($featured)
                <img src="{{ asset('storage/'.$featured->gambar) }}" alt="">
                @else
                <img src="{{ asset('assets/images/default-featured.png') }}" alt="">
                @endif
            </div>
            <p><strong>Judul:</strong> {{ $featured->judul }}</p>
            <p><strong>Sub Judul:</strong> {{ $featured->sub_judul }}</p>

            {{-- Accordion --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6>Accordion (FAQ)</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAccordion">+ Tambah Accordion</button>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accordions as $accordion)
                    <tr>
                        <td>{{ $accordion->pertanyaan }}</td>
                        <td>{{ $accordion->jawaban }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditAccordion{{ $accordion->id }}">Edit</button>
                        </td>
                    </tr>

                    {{-- Modal Edit Accordion --}}
                    <div class="modal fade" id="modalEditAccordion{{ $accordion->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.accordion.update', $accordion->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Accordion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="pertanyaan" value="{{ $accordion->pertanyaan }}" class="form-control mb-2">
                                        <textarea name="jawaban" class="form-control">{{ $accordion->jawaban }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
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

    {{-- Modal Edit Featured --}}
    <div class="modal fade" id="modalEditFeatured" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.featured.update', $featured->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Featured</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="judul" value="{{ $featured->judul }}" class="form-control mb-2">
                        <input type="text" name="sub_judul" value="{{ $featured->sub_judul }}" class="form-control mb-2">
                        <span> Gambar </span>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Accordion --}}
    <div class="modal fade" id="modalTambahAccordion" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.accordion.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Accordion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="pertanyaan" class="form-control mb-2" placeholder="Pertanyaan">
                        <textarea name="jawaban" class="form-control" placeholder="Jawaban"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== Video ===== --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Recap Video</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahVideo">+ Tambah Video</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Link</th>
                        <th>Thumbnail</th>
                        <th>Background</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                    <tr>
                        <td>{{ $video->judul }}</td>
                        <td><a href="{{ $video->link }}" target="_blank">{{ $video->link }}</a></td>
                        <td><img src="{{ asset('storage/'.$video->thumbnail) }}" width="120"></td>
                        <td><img src="{{ asset('storage/'.$video->background) }}" width="120"></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditVideo{{ $video->id }}">Edit</button>
                            <form action="{{ route('admin.video.destroy', $video->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus video ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit Video --}}
                    <div class="modal fade" id="modalEditVideo{{ $video->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Video</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="judul" value="{{ $video->judul }}" class="form-control mb-2">
                                        <input type="url" name="link" value="{{ $video->link }}" class="form-control mb-2">
                                        <span> Thumbnail </span>
                                        <input type="file" name="thumbnail" class="form-control mb-2">
                                        <span> Background </span>
                                        <input type="file" name="background" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
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

    {{-- Modal Tambah Video --}}
    <div class="modal fade" id="modalTambahVideo" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="judul" class="form-control mb-2" placeholder="Judul Video">
                        <input type="url" name="link" class="form-control mb-2" placeholder="Link Video">
                        <span> Thumbnail </span>
                        <input type="file" name="thumbnail" class="form-control mb-2">
                        <span> Background </span>
                        <input type="file" name="background" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== Statistik ===== --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Statistik LKBB</h5>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditJudulStatistik">Edit Judul</button>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahStatistik">+ Tambah Statistik</button>
        </div>
        <div class="card-body">
            <p><strong>Judul Section:</strong> {{ $statistikJudul }}</p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Jumlah</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statistiks as $stat)
                    <tr>
                        <td>{{ $stat->label }}</td>
                        <td>{{ $stat->jumlah }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditStatistik{{ $stat->id }}">Edit</button>
                        </td>
                    </tr>

                    {{-- Modal Edit Statistik --}}
                    <div class="modal fade" id="modalEditStatistik{{ $stat->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.statistik.update', $stat->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Statistik</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="label" value="{{ $stat->label }}" class="form-control mb-2">
                                        <input type="number" name="jumlah" value="{{ $stat->jumlah }}" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
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

    {{-- Modal Tambah Statistik --}}
    <div class="modal fade" id="modalTambahStatistik" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.statistik.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Statistik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="label" class="form-control mb-2" placeholder="Label">
                        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Judul Statistik --}}
    <div class="modal fade" id="modalEditJudulStatistik" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.statistik.judul.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Judul Statistik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="judul_section" value="{{ $statistikJudul }}" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== Juara ===== --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Juara LKBB</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahJuara">+ Tambah Juara</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Tahun</th>
                        <th>Juara</th>
                        <th>Nama Sekolah</th>
                        <th>Pelatih</th>
                        <th>Jumlah Tim</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($juaras as $juara)
                    <tr>
                        <td>{{ $juara->tahun }}</td>
                        <td>{{ $juara->juara }}</td>
                        <td>{{ $juara->nama_sekolah }}</td>
                        <td>{{ $juara->pelatih }}</td>
                        <td>{{ $juara->jumlah_tim }}</td>
                        <td>
                            @if($juara->gambar)
                            <img src="{{ asset('storage/'.$juara->gambar) }}" width="100" class="rounded">
                            @else
                            <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>{{ $juara->deskripsi }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditJuara{{ $juara->id }}">Edit</button>
                            <form action="{{ route('admin.juara.destroy', $juara->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus juara ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit Juara --}}
                    <div class="modal fade" id="modalEditJuara{{ $juara->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.juara.update', $juara->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Juara</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="number" name="tahun" value="{{ $juara->tahun }}" class="form-control mb-2">
                                        <input type="number" name="juara" value="{{ $juara->juara }}" class="form-control mb-2">
                                        <input type="text" name="nama_sekolah" value="{{ $juara->nama_sekolah }}" class="form-control mb-2">
                                        <input type="text" name="pelatih" value="{{ $juara->pelatih }}" class="form-control mb-2">
                                        <input type="number" name="jumlah_tim" value="{{ $juara->jumlah_tim }}" class="form-control mb-2">
                                        <span> Gambar </span>
                                        <input type="file" name="gambar" class="form-control mb-2">
                                        <textarea name="deskripsi" class="form-control">{{ $juara->deskripsi }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
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

    {{-- Modal Tambah Juara --}}
    <div class="modal fade" id="modalTambahJuara" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.juara.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Juara</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="number" name="tahun" class="form-control mb-2" placeholder="Tahun">
                        <input type="number" name="juara" class="form-control mb-2" placeholder="Juara Ke">
                        <input type="text" name="nama_sekolah" class="form-control mb-2" placeholder="Nama Sekolah">
                        <input type="text" name="pelatih" class="form-control mb-2" placeholder="Pelatih">
                        <input type="number" name="jumlah_tim" class="form-control mb-2" placeholder="Jumlah Tim">
                        <span> Gambar </span>
                        <input type="file" name="gambar" class="form-control mb-2">
                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
@endsection