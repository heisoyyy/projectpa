@extends('admin.komponen.komponen')

@section('title', 'Detail Sekolah')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Detail Pendaftaran Tim- {{ $team->nama_tim }}</h2>

    {{-- Info Sekolah --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Data Tim Sekolah</h5>
            <p><strong>Nama Tim:</strong> {{ $team->nama_tim }}</p>
            <p><strong>Alamat:</strong> {{ $team->user->kota ?? '-' }}</p>
            <p><strong>Status:</strong>
                @if($team->status == 'pending')
                <span class="badge bg-warning">Belum Diverifikasi</span>
                @elseif($team->status == 'verified')
                <span class="badge bg-success">Terverifikasi</span>
                @else
                <span class="badge bg-danger">Perlu Perbaikan</span>
                @endif
            </p><button class="btn btn-sm btn-warning"
                data-bs-toggle="modal"
                data-bs-target="#editUserModal{{ $team->id }}">
                <i class="bi bi-pencil"></i> Mengubah Tim
            </button>
        </div>
    </div>

    {{-- Data Peserta --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Daftar Peserta</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>NIS</th>
                        <th>Kartu Pelajar</th>
                        <th>Pas Photo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($team->members->where('role','peserta')->values() as $i => $peserta)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ ucfirst($peserta->posisi) }}</td>
                        <td>{{ $peserta->nis }}</td>
                        <td>
                            @if($peserta->dokumen_1)
                            <a href="{{ asset('storage/'.$peserta->dokumen_1) }}" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($peserta->dokumen_2)
                            <a href="{{ asset('storage/'.$peserta->dokumen_2) }}" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada peserta</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Data Pelatih --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Data Pelatih</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No HP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($team->members->where('role','pelatih')->values() as $i => $pelatih)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $pelatih->nama }}</td>
                        <td>{{ $pelatih->nomor_hp ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada pelatih</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol Verifikasi + Back --}}
    <div class="d-flex gap-2">
        {{-- Form Verifikasi --}}
        <form action="{{ route('admin.verifikasi', $team->id) }}" method="POST">
            @csrf
            <button type="submit" name="status" value="pending" class="btn btn-warning">Belum Lengkap</button>
            <button type="submit" name="status" value="verified" class="btn btn-success">Terverifikasi</button>
        </form>

        {{-- Tombol Back (pisah dari form) --}}
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">⬅ Kembali</button>
    </div>

</div>
{{-- MODAL EDIT SEMUA DATA --}}
<div class="modal fade" id="editUserModal{{ $team->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form action="{{ route('admin.updateTim', $team->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Tim & Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- DATA TIM --}}
                    <h5 class="mb-3">Data Tim</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Tim</label>
                            <input type="text" name="nama_tim" class="form-control" value="{{ $team->nama_tim }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Alamat / Kota</label>
                            <input type="text" name="kota" class="form-control" value="{{ $team->user->kota }}">
                        </div>
                    </div>

                    <hr>

                    {{-- DATA PESERTA --}}
                    <h5 class="mb-3">Data Peserta</h5>
                    @foreach($team->members->where('role','peserta') as $p)
                    <div class="border rounded p-3 mb-3">
                        <input type="hidden" name="peserta[{{ $p->id }}][id]" value="{{ $p->id }}">

                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Nama Peserta</label>
                                <input type="text" class="form-control" name="peserta[{{ $p->id }}][nama]" value="{{ $p->nama }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Posisi</label>
                                <select class="form-control" name="peserta[{{ $p->id }}][posisi]">
                                    <option value="Danton" {{ $p->posisi=='Danton' ? 'selected':'' }}>Danton</option>
                                    <option value="Anggota" {{ $p->posisi=='Anggota' ? 'selected':'' }}>Anggota</option>
                                    <option value="Cadangan" {{ $p->posisi=='Cadangan' ? 'selected':'' }}>Cadangan</option>
                                </select>   
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>NIS</label>
                                <input type="text" class="form-control" name="peserta[{{ $p->id }}][nis]" value="{{ $p->nis }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Kartu Pelajar (PDF/JPG)</label>
                                <input type="file" class="form-control" name="peserta[{{ $p->id }}][dokumen_1]">
                            </div>
                            <div class="col-md-6">
                                <label>Pas Foto (JPG/PNG)</label>
                                <input type="file" class="form-control" name="peserta[{{ $p->id }}][dokumen_2]">
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <hr>

                    {{-- DATA PELATIH --}}
                    <h5 class="mb-3">Data Pelatih</h5>
                    @foreach($team->members->where('role','pelatih') as $pel)
                    <div class="border rounded p-3 mb-3">

                        <input type="hidden" name="pelatih[{{ $pel->id }}][id]" value="{{ $pel->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Nama Pelatih</label>
                                <input type="text" class="form-control" name="pelatih[{{ $pel->id }}][nama]" value="{{ $pel->nama }}">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>No HP</label>
                                <input type="text" class="form-control" name="pelatih[{{ $pel->id }}][nomor_hp]" value="{{ $pel->nomor_hp }}">
                            </div>
                        </div>

                    </div>
                    @endforeach

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>

            </form>

        </div>
    </div>
</div>


<script>
    window.addEventListener("pageshow", function(event) {
        if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
            location.reload();
        }
    });
</script>
@endsection