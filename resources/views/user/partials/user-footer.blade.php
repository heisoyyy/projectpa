<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                <a href="https://www.smanplusprovriau.sch.id/" class="text-dark">SMAN PLUS Provinsi Riau</a>
            </div>
            <div class="col-12 col-sm-6 text-center text-sm-end">
                Designed By <a href="" class="text-dark">IKAPLUS</a><br>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/a2/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('assets/a2/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets/a2/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/a2/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/a2/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/a2/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('assets/a2/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets/a2/js/main.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const formPeserta = document.getElementById('formPeserta');
    const formPelatih = document.getElementById('formPelatih');

    const jumlahPesertaInput = document.getElementById('jumlahPeserta');
    const jumlahPelatihInput = document.getElementById('jumlahPelatih');

    if (jumlahPesertaInput && formPeserta) {
        jumlahPesertaInput.addEventListener('change', function() {
            let jumlah = this.value;
            formPeserta.innerHTML = '';
            for (let i = 1; i <= jumlah; i++) {
                formPeserta.innerHTML += `
                    <h6>Peserta ${i}</h6>
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="peserta[${i}][nama]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>NIS</label>
                        <input type="text" name="peserta[${i}][nis]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Posisi</label>
                        <select name="peserta[${i}][posisi]" class="form-control" required>
                            <option value="Danton">Danton</option>
                            <option value="Anggota">Anggota</option>
                            <option value="Cadangan">Cadangan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Kartu Pelajar</label>
                        <input type="file" name="peserta[${i}][dokumen_1]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Pas Photo</label>
                        <input type="file" name="peserta[${i}][dokumen_2]" class="form-control" required>
                    </div>
                    <hr>`;
            }
        });
    }

    if (jumlahPelatihInput && formPelatih) {
        jumlahPelatihInput.addEventListener('change', function() {
            let jumlah = this.value;
            formPelatih.innerHTML = '';
            for (let i = 1; i <= jumlah; i++) {
                formPelatih.innerHTML += `
                    <h6>Pelatih ${i}</h6>
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="pelatih[${i}][nama]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>NO HP</label>
                        <input type="text" name="pelatih[${i}][nomor_hp]" maxlength="12" class="form-control" required>
                    </div>
                    <hr>`;
            }
        });
    }
});
</script>


<script>
    // misalnya jadwal tampil jam 10:15
    const tampilTime = new Date("2025-06-21T10:15:00").getTime();
    const countdown = document.getElementById("countdown");

    setInterval(function() {
        const now = new Date().getTime();
        const distance = tampilTime - now;

        if (distance <= 0) {
            countdown.innerHTML = "Sedang Tampil";
        } else {
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            countdown.innerHTML = `${hours}:${minutes}:${seconds}`;
        }
    }, 1000);
</script>

