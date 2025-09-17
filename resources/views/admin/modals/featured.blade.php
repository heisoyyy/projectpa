{{-- Modal Edit Featured --}}
<div class="modal fade" id="modalEditFeatured" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('featured.update', $featured->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Featured</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Judul</label>
                    <input type="text" name="judul" value="{{ $featured->judul }}" class="form-control" required>

                    <label>Sub Judul</label>
                    <input type="text" name="sub_judul" value="{{ $featured->sub_judul }}" class="form-control" required>

                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                    <small>Gambar sekarang: {{ $featured->gambar }}</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update Featured</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Tambah Accordion --}}
<div class="modal fade" id="modalTambahAccordion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('accordion.store') }}" method="POST">
            @csrf
            <input type="hidden" name="featured_id" value="{{ $featured->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Accordion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control" required>

                    <label>Jawaban</label>
                    <textarea name="jawaban" class="form-control" rows="4" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Accordion</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Accordion --}}
@foreach($accordions as $accordion)
<div class="modal fade" id="modalEditAccordion{{ $accordion->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('accordion.update', $accordion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Accordion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Pertanyaan</label>
                    <input type="text" name="pertanyaan" value="{{ $accordion->pertanyaan }}" class="form-control" required>

                    <label>Jawaban</label>
                    <textarea name="jawaban" class="form-control" rows="4" required>{{ $accordion->jawaban }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update Accordion</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach