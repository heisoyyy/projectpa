  <!-- Footer -->
  <footer class="text-black text-center py-3 mt-auto">
      &copy; {{ date('Y') }} SMAN PLUS PROVINSI RIAU. All rights reserved.
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Sidebar Toggle -->
   
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
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const pesertaWrapper = document.getElementById('pesertaWrapper');
          const pelatihWrapper = document.getElementById('pelatihWrapper');

          const addPesertaBtn = document.getElementById('addPesertaBtn');
          const addPelatihBtn = document.getElementById('addPelatihBtn');

          if (addPesertaBtn && pesertaWrapper) {
              addPesertaBtn.addEventListener('click', function() {
                  let index = Date.now();
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
                <label class="form-label">Pas Foto</label>
                <input type="file" class="form-control mb-2"
                       name="peserta[new_${index}][dokumen_2]">
            </div>`;
                  pesertaWrapper.insertAdjacentHTML('beforeend', html);
              });
          }

          if (addPelatihBtn && pelatihWrapper) {
              addPelatihBtn.addEventListener('click', function() {
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

  <script>
      document.addEventListener('DOMContentLoaded', function() {
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