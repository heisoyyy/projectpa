{{-- Modal Tambah Juara --}}
<div class="modal fade" id="modalTambahJuara" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Juara</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" class="form-control" placeholder="Contoh: 2024">
            </div>
            <div class="mb-3">
                <label class="form-label">Juara Ke-</label>
                <input type="number" class="form-control" placeholder="Contoh: 1">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Sekolah</label>
                <input type="text" class="form-control" placeholder="Nama sekolah">
            </div>
            <div class="mb-3">
                <label class="form-label">Pelatih</label>
                <input type="text" class="form-control" placeholder="Nama pelatih">
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Tim</label>
                <input type="number" class="form-control" placeholder="Jumlah tim">
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" rows="3" placeholder="Deskripsi juara"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

{{-- Modal Edit Juara --}}
<div class="modal fade" id="modalEditJuara" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Juara</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" class="form-control" value="2024">
            </div>
            <div class="mb-3">
                <label class="form-label">Juara Ke-</label>
                <input type="number" class="form-control" value="1">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Sekolah</label>
                <input type="text" class="form-control" value="SMAN 1 Pekanbaru">
            </div>
            <div class="mb-3">
                <label class="form-label">Pelatih</label>
                <input type="text" class="form-control" value="Bapak Egy Maulana">
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Tim</label>
                <input type="number" class="form-control" value="26">
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" rows="3">Lorem ipsum dolor sit amet...</textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>