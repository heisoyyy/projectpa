{{-- Modal Tambah Juara --}}
<div class="modal fade" id="modalTambahJuara" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('juara.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Juara</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label>Tahun</label>
          <input type="number" name="tahun" class="form-control" required>

          <label>Juara (1/2/3)</label>
          <input type="number" name="juara" class="form-control" required>

          <label>Nama Sekolah</label>
          <input type="text" name="nama_sekolah" class="form-control" required>

          <label>Pelatih</label>
          <input type="text" name="pelatih" class="form-control" required>

          <label>Jumlah Tim</label>
          <input type="number" name="jumlah_tim" class="form-control" required>

          <label>Gambar</label>
          <input type="file" name="gambar" class="form-control">

          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambah Juara</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Modal Edit Juara --}}
@foreach($juaras as $juara)
<div class="modal fade" id="modalEditJuara{{ $juara->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('juara.update', $juara->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Juara</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label>Tahun</label>
          <input type="number" name="tahun" value="{{ $juara->tahun }}" class="form-control" required>

          <label>Juara (1/2/3)</label>
          <input type="number" name="juara" value="{{ $juara->juara }}" class="form-control" required>

          <label>Nama Sekolah</label>
          <input type="text" name="nama_sekolah" value="{{ $juara->nama_sekolah }}" class="form-control" required>

          <label>Pelatih</label>
          <input type="text" name="pelatih" value="{{ $juara->pelatih }}" class="form-control" required>

          <label>Jumlah Tim</label>
          <input type="number" name="jumlah_tim" value="{{ $juara->jumlah_tim }}" class="form-control" required>

          <label>Gambar</label>
          <input type="file" name="gambar" class="form-control">
          <small>Gambar sekarang: {{ $juara->gambar }}</small>

          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4">{{ $juara->deskripsi }}</textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update Juara</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach