{{-- Modal Cek Tim --}}
<div class="modal fade" id="cekTimModal" tabindex="-1" aria-labelledby="cekTimModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Tim</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if($team && $team->members->count() > 0)
                    <p><strong>Nama Tim:</strong> {{ $team->nama_tim }}</p>
                    <p><strong>Jumlah Peserta:</strong> {{ $team->members->where('role','peserta')->count() }}</p>
                    <p><strong>Jumlah Pelatih:</strong> {{ $team->members->where('role','pelatih')->count() }}</p>

                    <hr>
                    <h6>Peserta</h6>
                    <ul class="list-group mb-3">
                        @foreach($team->members->where('role','peserta') as $p)
                            <li class="list-group-item">
                                <strong>Nama:</strong> {{ $p->nama }} <br>
                                <strong>Posisi:</strong> {{ $p->posisi }} <br>
                                <strong>NIS:</strong> {{ $p->nis }}
                            </li>
                        @endforeach
                    </ul>

                    <h6>Pelatih</h6>
                    <ul class="list-group">
                        @foreach($team->members->where('role','pelatih') as $p)
                            <li class="list-group-item">
                                <strong>Nama:</strong> {{ $p->nama }} <br>
                                <strong>No HP:</strong> {{ $p->nomor_hp }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada tim yang didaftarkan.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
