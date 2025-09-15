{{-- Modal Tambah Accordion --}}
<div class="modal fade" id="modalTambahAccordion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Accordion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" class="form-control" placeholder="Masukkan pertanyaan">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jawaban</label>
                    <textarea class="form-control" rows="3" placeholder="Masukkan jawaban"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Accordion (contoh satu modal dipakai edit) --}}
<div class="modal fade" id="modalEditAccordion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Accordion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" class="form-control" value="LKBB Komando ?">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jawaban</label>
                    <textarea class="form-control" rows="3">Ajang tahunan yang diselenggarakan SMAN Plus Provinsi Riau ...</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</div>

{{-- ================= MODAL EDIT FEATURED ================= --}}
<div class="modal fade" id="modalEditFeatured" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Featured</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Upload Gambar</label>
            <input type="file" class="form-control">
            <small class="text-muted">Format: JPG, PNG | Max: 2MB</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" class="form-control" value="Lomba Ketangkasan Baris Berbaris">
        </div>
        <div class="mb-3">
            <label class="form-label">Sub Judul</label>
            <input type="text" class="form-control" value="KOMANDO">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-success">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>