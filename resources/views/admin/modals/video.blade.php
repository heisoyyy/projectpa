{{-- Modal Tambah Video --}}
<div class="modal fade" id="modalTambahVideo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('video.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>

                    <label>Link Youtube</label>
                    <input type="text" name="link" class="form-control" required>

                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Video</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Video --}}
@foreach($videos as $video)
<div class="modal fade" id="modalEditVideo{{ $video->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('video.update', $video->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Judul</label>
                    <input type="text" name="judul" value="{{ $video->judul }}" class="form-control" required>

                    <label>Link Youtube</label>
                    <input type="text" name="link" value="{{ $video->link }}" class="form-control" required>

                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control">
                    <small>Thumbnail sekarang: {{ $video->thumbnail }}</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update Video</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach