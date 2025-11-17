{{-- ========================== FOOTER ========================== --}}
<footer class="text-black text-center py-3 mt-auto">
    &copy; {{ date('Y') }} SMAN PLUS PROVINSI RIAU. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Sidebar Toggle --}}
<script>
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');
const sidebarToggle = document.getElementById('sidebarToggle');
const overlay = document.getElementById('overlay');

sidebarToggle.addEventListener('click', () => {
    if (window.innerWidth < 768) {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    } else {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('expanded');
    }
});

overlay.addEventListener('click', () => {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
});

window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }
});
</script>


{{-- ========================== SCRIPT TABEL PESERTA & PELATIH ========================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ================= PESERTA =================
    const formPeserta = document.getElementById('formPeserta');
    const jumlahPesertaInput = document.getElementById('jumlahPeserta');

    jumlahPesertaInput?.addEventListener('change', function () {
        let jumlah = this.value;
        formPeserta.innerHTML = "";

        for (let i = 1; i <= jumlah; i++) {
            formPeserta.innerHTML += `
                <tr>
                    <td>${i}</td>
                    <td><input type="text" class="form-control" name="peserta[${i}][nama]" required></td>
                    <td><input type="text" class="form-control" name="peserta[${i}][nis]" required></td>
                    <td>
                        <select class="form-select" name="peserta[${i}][posisi]" required>
                            <option value="Danton">Danton</option>
                            <option value="Anggota">Anggota</option>
                            <option value="Cadangan">Cadangan</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" name="peserta[${i}][dokumen_1]" required></td>
                    <td><input type="file" class="form-control" name="peserta[${i}][dokumen_2]" required></td>
                </tr>
            `;
        }
    });

    // ================= PELATIH =================
    const formPelatih = document.getElementById('formPelatih');
    const jumlahPelatihInput = document.getElementById('jumlahPelatih');

    jumlahPelatihInput?.addEventListener('change', function () {
        let jumlah = this.value;
        formPelatih.innerHTML = "";

        for (let i = 1; i <= jumlah; i++) {
            formPelatih.innerHTML += `
                <tr>
                    <td>${i}</td>
                    <td><input type="text" class="form-control" name="pelatih[${i}][nama]" required></td>
                    <td><input type="text" maxlength="12" class="form-control" name="pelatih[${i}][nomor_hp]" required></td>
                </tr>
            `;
        }
    });

});
</script>