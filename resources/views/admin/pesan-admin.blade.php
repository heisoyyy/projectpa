@extends('.admin.komponen.admin-komponen')

@section('title', 'Pesan Admin')

@section('content')
<h3 class="mb-4">Kelola Pesan</h3>

<!-- Tombol Kirim Pesan -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#kirimPesanModal">
    + Kirim Pesan
</button>

<!-- Modal Kirim Pesan -->
<div class="modal fade" id="kirimPesanModal" tabindex="-1" aria-labelledby="kirimPesanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="kirimPesanLabel">Kirim Pesan Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.pesan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tujuan Sekolah</label>
                        <div class="border rounded p-2" style="max-height: 200px; overflow-y:auto;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="all" id="allSchools">
                                <label class="form-check-label fw-bold text-primary" for="allSchools">Semua Sekolah</label>
                            </div>
                            <hr class="my-2">
                            @foreach($teams as $team)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tujuan[]" value="{{ $team->id }}" id="team{{ $team->id }}">
                                <label class="form-check-label" for="team{{ $team->id }}">{{ $team->user->nama_sekolah ?? '-' }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul Pesan</label>
                        <input type="text" name="judul" class="form-control" placeholder="Judul pesan..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Pesan</label>
                        <textarea name="isi" class="form-control" rows="4" placeholder="Tulis pesan..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tabel Daftar Pesan -->
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Daftar Pesan</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Dikirim ke</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesans as $i => $pesan)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $pesan->judul }}</td>
                    <td>{{ $pesan->isi }}</td>
                    <td>{{ $pesan->nama_sekolah_tujuan }}</td>
                    <td>{{ $pesan->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.pesan.destroy',$pesan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Checkbox semua sekolah
    document.getElementById('allSchools').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="tujuan[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>

@endsection