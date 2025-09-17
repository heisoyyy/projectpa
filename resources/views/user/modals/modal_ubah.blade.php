@if($team)
<div class="modal fade" id="ubahTimModal" tabindex="-1" aria-labelledby="ubahTimModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('user.pendaftaran.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Tim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    {{-- ================= PESERTA ================= --}}
                    <h5 class="mb-3">Peserta</h5>
                    <div id="pesertaWrapper">
                        @foreach($team->members->where('role','peserta') as $i => $p)
                        <div class="mb-3 border-bottom pb-2">
                            <h6>Peserta {{ $i+1 }}</h6>

                            <input type="text" class="form-control mb-1"
                                name="peserta[{{ $p->id }}][nama]"
                                value="{{ $p->nama }}" placeholder="Nama" required>

                            <select class="form-control mb-1" name="peserta[{{ $p->id }}][posisi]" required>
                                <option value="">-- Pilih Posisi --</option>
                                <option value="danton" {{ $p->posisi=='danton' ? 'selected' : '' }}>Danton</option>
                                <option value="anggota" {{ $p->posisi=='anggota' ? 'selected' : '' }}>Anggota</option>
                                <option value="cadangan" {{ $p->posisi=='cadangan' ? 'selected' : '' }}>Cadangan</option>
                            </select>

                            <input type="text" class="form-control mb-1"
                                name="peserta[{{ $p->id }}][nis]"
                                value="{{ $p->nis }}" placeholder="NIS">

                            <label class="form-label">Kartu Pelajar</label>
                            <input type="file" class="form-control mb-1" name="peserta[{{ $p->id }}][dokumen_1]">
                            @if($p->dokumen_1)
                            <small>File saat ini: <a href="{{ asset('storage/'.$p->dokumen_1) }}" target="_blank">Lihat</a></small>
                            @endif

                            <label class="form-label">Pas Foto</label>
                            <input type="file" class="form-control mb-1" name="peserta[{{ $p->id }}][dokumen_2]">
                            @if($p->dokumen_2)
                            <small>File saat ini: <a href="{{ asset('storage/'.$p->dokumen_2) }}" target="_blank">Lihat</a></small>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-success mb-3" id="addPesertaBtn">+ Tambah Peserta</button>

                    <hr>

                    {{-- ================= PELATIH ================= --}}
                    <h5 class="mb-3">Pelatih</h5>
                    <div id="pelatihWrapper">
                        @foreach($team->members->where('role','pelatih') as $i => $p)
                        <div class="mb-3 border-bottom pb-2">
                            <h6>Pelatih {{ $i+1 }}</h6>

                            <input type="text" class="form-control mb-1"
                                name="pelatih[{{ $p->id }}][nama]"
                                value="{{ $p->nama }}" placeholder="Nama" required>

                            <input type="text" class="form-control mb-1"
                                name="pelatih[{{ $p->id }}][nomor_hp]"
                                value="{{ $p->nomor_hp }}" placeholder="Nomor HP">
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-success mb-3" id="addPelatihBtn">+ Tambah Pelatih</button>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif