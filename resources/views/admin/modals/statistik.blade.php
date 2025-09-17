{{-- Modal Edit Judul Statistik --}}
<div class="modal fade" id="modalEditJudulStatistik" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('statistik.judul.update') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Judul Statistik</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label>Judul Section</label>
          <input type="text" name="judul_section" value="{{ $statistikJudul }}" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update Judul</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Modal Tambah Statistik --}}
<div class="modal fade" id="modalTambahStatistik" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('statistik.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Statistik</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label>Label</label>
          <input type="text" name="label" class="form-control" required>

          <label>Jumlah</label>
          <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambah Statistik</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Modal Edit Statistik --}}
@foreach($statistiks as $stat)
<div class="modal fade" id="modalEditStatistik{{ $stat->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('statistik.update', $stat->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Statistik</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label>Label</label>
          <input type="text" name="label" value="{{ $stat->label }}" class="form-control" required>

          <label>Jumlah</label>
          <input type="number" name="jumlah" value="{{ $stat->jumlah }}" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update Statistik</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach