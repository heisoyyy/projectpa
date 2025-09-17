<!-- Modal Edit Accordion -->
@foreach($accordions as $accordion)
<div class="modal fade" id="modalEditAccordion-{{ $accordion->id }}" tabindex="-1" aria-hidden="true">
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
                    <input type="text" name="pertanyaan" class="form-control" value="{{ $accordion->pertanyaan }}" required>

                    <label>Jawaban</label>
                    <textarea name="jawaban" class="form-control" required>{{ $accordion->jawaban }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal Tambah Accordion -->
<div class="modal fade" id="modalTambahAccordion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('accordion.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Accordion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control" required>

                    <label>Jawaban</label>
                    <textarea name="jawaban" class="form-control" required></textarea>

                    <label>Featured</label>
                    <select name="featured_id" class="form-control" required>
                        @foreach($featured ? [$featured] : [] as $f)
                        <option value="{{ $f->id }}">{{ $f->judul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endforeach