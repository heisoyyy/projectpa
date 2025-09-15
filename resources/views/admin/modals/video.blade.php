<!-- Modal Tambah Video -->
<div class="modal fade" id="modalTambahVideo" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Video</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Link</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Thumbnail</label>
                        <input type="file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Video -->
<div class="modal fade" id="modalEditVideo" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Video</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" class="form-control" value="LKBB Komando">
                    </div>
                    <div class="mb-3">
                        <label>Link</label>
                        <input type="text" class="form-control" value="https://youtube.com">
                    </div>
                    <div class="mb-3">
                        <label>Thumbnail</label>
                        <input type="file" class="form-control">
                    </div>
                    <img src="assets/images/video-frame.jpg" width="100" class="mt-2 rounded">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
