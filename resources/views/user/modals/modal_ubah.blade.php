@if($team)
<div class="modal fade" id="ubahTimModal" tabindex="-1" aria-labelledby="ubahTimModal" aria-hidden="true">
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
                    @foreach($team->members->where('role','peserta') as $i => $p)
                        <div class="mb-3 border-bottom pb-2">
                            <h6>Peserta {{ $i+1 }}</h6>

                            <!-- Nama -->
                            <input type="text" class="form-control mb-1"
                                name="peserta[{{ $p->id }}][nama]"
                                value="{{ $p->nama }}" placeholder="Nama" required>

                            <!-- Posisi -->
                            <select class="form-control mb-1" name="peserta[{{ $p->id }}][posisi]">
                                <option value="" {{ !$p->posisi ? 'selected' : '' }}>-- Pilih Posisi --</option>
                                <option value="danton" {{ $p->posisi=='danton' ? 'selected' : '' }}>Danton</option>
                                <option value="anggota" {{ $p->posisi=='anggota' ? 'selected' : '' }}>Anggota</option>
                                <option value="cadangan" {{ $p->posisi=='cadangan' ? 'selected' : '' }}>Cadangan</option>
                            </select>

                            <!-- NIS -->
                            <input type="text" class="form-control mb-1"
                                name="peserta[{{ $p->id }}][nis]"
                                value="{{ $p->nis }}" placeholder="NIS">

                            <!-- Kartu Pelajar -->
                            <label class="form-label">Kartu Pelajar</label>
                            <input type="file" class="form-control mb-1"
                                name="peserta[{{ $p->id }}][dokumen_1]">
                            @if($p->dokumen_1)
                                <small>File saat ini: <a href="{{ asset('storage/'.$p->dokumen_1) }}" target="_blank">Lihat</a></small>
                            @endif

                            <!-- Pas Foto -->
                            <label class="form-label">Pas Foto</label>
                            <input type="file" class="form-control mb-1"
                                name="peserta[{{ $p->id }}][dokumen_2]">
                            @if($p->dokumen_2)
                                <small>File saat ini: <a href="{{ asset('storage/'.$p->dokumen_2) }}" target="_blank">Lihat</a></small>
                            @endif
                        </div>
                    @endforeach

                    {{-- Tombol tambah peserta --}}
                    <div id="newPeserta"></div>
                    <button type="button" class="btn btn-sm btn-success" onclick="addPeserta()">+ Tambah Peserta</button>

                    <hr>

                    {{-- ================= PELATIH ================= --}}
                    <h5 class="mb-3">Pelatih</h5>
                    @foreach($team->members->where('role','pelatih') as $i => $p)
                        <div class="mb-3 border-bottom pb-2">
                            <h6>Pelatih {{ $i+1 }}</h6>

                            <!-- Nama -->
                            <input type="text" class="form-control mb-1"
                                name="pelatih[{{ $p->id }}][nama]"
                                value="{{ $p->nama }}" placeholder="Nama" required>

                            <!-- Nomor HP -->
                            <input type="text" class="form-control mb-1"
                                name="pelatih[{{ $p->id }}][nomor_hp]"
                                value="{{ $p->nomor_hp }}" placeholder="Nomor HP">
                        </div>
                    @endforeach

                    {{-- Tombol tambah pelatih --}}
                    <div id="newPelatih"></div>
                    <button type="button" class="btn btn-sm btn-success" onclick="addPelatih()">+ Tambah Pelatih</button>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script dinamis --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pesertaWrapper = document.getElementById('pesertaWrapper');
        const pelatihWrapper = document.getElementById('pelatihWrapper');

        document.getElementById('addPesertaBtn').addEventListener('click', function() {
            let index = Date.now(); // biar unik
            let html = `
            <div class="mb-3 border p-2 rounded">
                <h6>Peserta Baru</h6>
                <input type="text" class="form-control mb-2"
                    name="peserta[new_${index}][nama]" placeholder="Nama" required>
                <select class="form-select mb-2" name="peserta[new_${index}][posisi]" required>
                    <option value="" disabled selected>Pilih Posisi</option>
                    <option value="Danton">Danton</option>
                    <option value="Anggota">Anggota</option>
                    <option value="Cadangan">Cadangan</option>
                </select>
                <input type="text" class="form-control mb-2"
                    name="peserta[new_${index}][nis]" placeholder="NIS">
                <label class="form-label">Kartu Pelajar</label>
                <input type="file" class="form-control mb-2"
                    name="peserta[new_${index}][dokumen_1]">
                <label class="form-label">Pas Photo</label>
                <input type="file" class="form-control mb-2"
                    name="peserta[new_${index}][dokumen_2]">
            </div>`;
            pesertaWrapper.insertAdjacentHTML('beforeend', html);
        });

        document.getElementById('addPelatihBtn').addEventListener('click', function() {
            let index = Date.now();
            let html = `
                <div class="mb-3 border p-2 rounded">
                    <h6>Pelatih Baru</h6>
                    <input type="text" class="form-control mb-2"
                           name="pelatih[new_${index}][nama]" placeholder="Nama" required>
                    <input type="text" class="form-control mb-2"
                           name="pelatih[new_${index}][nomor_hp]" placeholder="Nomor HP">
                </div>`;
            pelatihWrapper.insertAdjacentHTML('beforeend', html);
        });
    });
</script>
@endif