@if($team)
{{-- ======================== MODAL EDIT PESERTA ======================== --}}
<div class="modal fade" id="modalEditPeserta" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formEditPeserta" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fa fa-edit"></i> Edit Data Peserta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="peserta_edit_id" name="peserta_id">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Peserta <span class="text-danger">*</span></label>
                        <input type="text" id="peserta_edit_nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">NIS <span class="text-danger">*</span></label>
                        <input type="text" id="peserta_edit_nis" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Posisi <span class="text-danger">*</span></label>
                        <select id="peserta_edit_posisi" class="form-select" required>
                            <option value="">-- Pilih Posisi --</option>
                            <option value="Danton">Danton</option>
                            <option value="Anggota">Anggota</option>
                            <option value="Cadangan">Cadangan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kartu Pelajar</label>
                        <div id="peserta_dokumen_1_preview" class="mb-2"></div>
                        <input type="file" id="peserta_edit_d1" class="form-control" accept="image/*,.pdf">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah dokumen</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pas Foto</label>
                        <div id="peserta_dokumen_2_preview" class="mb-2"></div>
                        <input type="file" id="peserta_edit_d2" class="form-control" accept="image/*,.pdf">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah dokumen</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ======================== MODAL EDIT PELATIH ======================== --}}
<div class="modal fade" id="modalEditPelatih" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formEditPelatih" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">
                        <i class="fa fa-edit"></i> Edit Data Pelatih
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="pelatih_edit_id" name="pelatih_id">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pelatih <span class="text-danger">*</span></label>
                        <input type="text" id="pelatih_edit_nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor HP <span class="text-danger">*</span></label>
                        <input type="text" id="pelatih_edit_hp" class="form-control" maxlength="15" required>
                        <small class="text-muted">Contoh: 081234567890</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ======================== SCRIPT MODAL PESERTA & PELATIH ======================== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// ================= PESERTA =================
function openEditPeserta(id) {
    const member = @json($team->members->where('role','peserta')->values());
    const peserta = member.find(m => m.id === id);
    
    if (!peserta) {
        Swal.fire('Error', 'Data peserta tidak ditemukan', 'error');
        return;
    }

    // Isi form
    document.getElementById('peserta_edit_id').value = peserta.id;
    document.getElementById('peserta_edit_nama').value = peserta.nama;
    document.getElementById('peserta_edit_nis').value = peserta.nis || '';
    document.getElementById('peserta_edit_posisi').value = peserta.posisi || '';

    // Preview dokumen
    const dok1Preview = document.getElementById('peserta_dokumen_1_preview');
    const dok2Preview = document.getElementById('peserta_dokumen_2_preview');

    dok1Preview.innerHTML = peserta.dokumen_1 
        ? `<a href="{{ asset('storage') }}/${peserta.dokumen_1}" target="_blank" class="btn btn-sm btn-info">
            <i class="fa fa-eye"></i> Lihat Dokumen Saat Ini
           </a>` 
        : '';

    dok2Preview.innerHTML = peserta.dokumen_2 
        ? `<a href="{{ asset('storage') }}/${peserta.dokumen_2}" target="_blank" class="btn btn-sm btn-info">
            <i class="fa fa-eye"></i> Lihat Foto Saat Ini
           </a>` 
        : '';

    // Set form action
    document.getElementById('formEditPeserta').action = 
        `{{ route('user.pendaftaran.update', $team->id) }}`;

    // Show modal
    new bootstrap.Modal(document.getElementById('modalEditPeserta')).show();
}

// Submit form peserta
document.getElementById('formEditPeserta').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData();
    const pesertaId = document.getElementById('peserta_edit_id').value;
    
    // Tambahkan data sesuai format controller
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('_method', 'PUT');
    formData.append(`peserta[${pesertaId}][nama]`, document.getElementById('peserta_edit_nama').value);
    formData.append(`peserta[${pesertaId}][nis]`, document.getElementById('peserta_edit_nis').value);
    formData.append(`peserta[${pesertaId}][posisi]`, document.getElementById('peserta_edit_posisi').value);
    
    // Upload file jika ada
    const file1 = document.getElementById('peserta_edit_d1').files[0];
    const file2 = document.getElementById('peserta_edit_d2').files[0];
    
    if (file1) formData.append(`peserta[${pesertaId}][dokumen_1]`, file1);
    if (file2) formData.append(`peserta[${pesertaId}][dokumen_2]`, file2);

    // Submit
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data peserta berhasil diperbarui',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                location.reload();
            });
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Terjadi kesalahan saat menyimpan data', 'error');
        console.error(error);
    });
});

// ================= PELATIH =================
function openEditPelatih(id) {
    const member = @json($team->members->where('role','pelatih')->values());
    const pelatih = member.find(m => m.id === id);
    
    if (!pelatih) {
        Swal.fire('Error', 'Data pelatih tidak ditemukan', 'error');
        return;
    }

    // Isi form
    document.getElementById('pelatih_edit_id').value = pelatih.id;
    document.getElementById('pelatih_edit_nama').value = pelatih.nama;
    document.getElementById('pelatih_edit_hp').value = pelatih.nomor_hp || '';

    // Set form action
    document.getElementById('formEditPelatih').action = 
        `{{ route('user.pendaftaran.update', $team->id) }}`;

    // Show modal
    new bootstrap.Modal(document.getElementById('modalEditPelatih')).show();
}

// Submit form pelatih
document.getElementById('formEditPelatih').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData();
    const pelatihId = document.getElementById('pelatih_edit_id').value;
    
    // Tambahkan data sesuai format controller
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('_method', 'PUT');
    formData.append(`pelatih[${pelatihId}][nama]`, document.getElementById('pelatih_edit_nama').value);
    formData.append(`pelatih[${pelatihId}][nomor_hp]`, document.getElementById('pelatih_edit_hp').value);

    // Submit
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data pelatih berhasil diperbarui',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                location.reload();
            });
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Terjadi kesalahan saat menyimpan data', 'error');
        console.error(error);
    });
});

// ================= HAPUS PESERTA =================
function hapusPeserta(id) {
    Swal.fire({
        title: 'Hapus Peserta?',
        text: "Data peserta akan dihapus dari tim!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('del_peserta_'+id).value = 1;
            Swal.fire('Ditandai!', 'Data peserta akan dihapus saat menyimpan', 'info');
        }
    });
}

// ================= HAPUS PELATIH =================
function hapusPelatih(id) {
    Swal.fire({
        title: 'Hapus Pelatih?',
        text: "Data pelatih akan dihapus dari tim!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('del_pelatih_'+id).value = 1;
            Swal.fire('Ditandai!', 'Data pelatih akan dihapus saat menyimpan', 'info');
        }
    });
}
</script>

@endif