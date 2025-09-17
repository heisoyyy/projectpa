{{-- Modal Tambah Banner --}}
<div class="modal fade" id="modalTambahBanner" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>

                    <label>Kategori</label>
                    <input type="text" name="kategori" class="form-control" required>

                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Banner --}}
@foreach($banners as $banner)
<div class="modal fade" id="modalEditBanner{{ $banner->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Judul</label>
                    <input type="text" name="judul" value="{{ $banner->judul }}" class="form-control" required>

                    <label>Kategori</label>
                    <input type="text" name="kategori" value="{{ $banner->kategori }}" class="form-control" required>

                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                    <small>Gambar sekarang: {{ $banner->gambar }}</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach