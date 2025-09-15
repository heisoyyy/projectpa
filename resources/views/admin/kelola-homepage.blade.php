@extends('.admin.komponen.admin-komponen')

@section('title', 'Kelola Homepage')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Kelola Homepage</h3>

    {{-- Banner Slider --}}
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
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SMAN PLUS PROVINSI RIAU</td>
                        <td>LKBB KOMANDO 2025</td>
                        <td><img src="assets/images/banner1.jpg" width="120"></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditBanner">Edit</button>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="hapusData('SMAN PLUS PROVINSI RIAU')">
                                Hapus
                            </button>
                        </td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Featured Section --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Kelola Featured Section</h5>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditFeatured">
                Edit Featured
            </button>
        </div>
        <div class="card-body">

            {{-- Preview Featured --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Gambar Featured</label><br>
                <img src="{{ asset('assets/images/featured.jpg') }}" alt="Featured" class="img-thumbnail" width="250">
            </div>
            <p class="mb-1"><strong>Judul:</strong> Lomba Ketangkasan Baris Berbaris</p>
            <p class="mb-3"><strong>Sub Judul:</strong> KOMANDO</p>

            {{-- Daftar Accordion --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6>Accordion (FAQ)</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAccordion">
                    + Tambah Accordion
                </button>
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
                    <tr>
                        <td>LKBB Komando ?</td>
                        <td>Ajang tahunan yang diselenggarakan SMAN Plus Provinsi Riau ...</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditAccordion">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="hapusData('SMAN PLUS PROVINSI RIAU')">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    {{-- Video Recap --}}
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>LKBB Komando</td>
                        <td><a href="https://youtube.com" target="_blank">https://youtube.com</a></td>
                        <td><img src="assets/images/video-frame.jpg" width="120"></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditVideo">Edit</button>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="hapusData('SMAN PLUS PROVINSI RIAU')">
                                Hapus
                            </button>
                        </td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Statistik LKBB</h5>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditJudulStatistik">
                Edit Judul
            </button>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahStatistik">
                + Tambah Statistik
            </button>
        </div>
        <div class="card-body">

            {{-- Preview Judul --}}
            <p><strong>Judul Section:</strong> LKBB Komando 2025</p>

            {{-- Tabel Statistik --}}
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Jumlah</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pendaftar</td>
                        <td>20</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditStatistik">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="hapusData('Pendaftar')">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Diterima</td>
                        <td>11</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditStatistik">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="hapusData('Diterima')">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Diproses</td>
                        <td>9</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditStatistik">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="hapusData('Diproses')">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    {{-- Juara LKBB --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Juara LKBB</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahJuara">
                + Tambah Juara
            </button>
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
                    {{-- Contoh Data --}}
                    <tr>
                        <td>2024</td>
                        <td>1</td>
                        <td>SMAN 1 Pekanbaru</td>
                        <td>Bapak Egy Maulana</td>
                        <td>26</td>
                        <td><img src="assets/images/deal-01.jpg" width="100" class="rounded"></td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditJuara">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="hapusData('SMAN 1 Pekanbaru')">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2024</td>
                        <td>2</td>
                        <td>SMAN 2 Pekanbaru</td>
                        <td>Bapak Rizky Ridho</td>
                        <td>24</td>
                        <td><img src="assets/images/deal-02.jpg" width="100" class="rounded"></td>
                        <td>Deskripsi singkat juara 2 SMAN 2 Pekanbaru.</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditJuara">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="hapusData('SMAN 2 Pekanbaru')">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ====== Modal Template (Contoh) ====== --}}
    {{-- Banner --}}
    @include('admin.modals.banner')
    {{-- Featured --}}
    @include('admin.modals.featured')
    {{-- Video --}}
    @include('admin.modals.video')
    {{-- Statistik --}}
    @include('admin.modals.statistik')
    {{-- Juara --}}
    @include('admin.modals.juara')

    @endsection