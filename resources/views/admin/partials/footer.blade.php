  <!-- Footer -->
  <footer class="text-black text-center py-3 mt-auto">
      SMAN PLUS PROVINSI RIAU. All rights reserved.
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
  <!-- Script Dinamis -->
  <script>
      // Generate Peserta
      function generatePeserta(jumlah) {
          let container = document.getElementById('formPeserta');
          container.innerHTML = '';
          for (let i = 1; i <= jumlah; i++) {
              container.innerHTML += `
                <div class="card mb-3 p-3">
                    <h6 class="text-muted">Peserta ${i}</h6>
                    <div class="mb-2">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="peserta[${i}][nama]" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">NIS</label>
                        <input type="text" class="form-control" name="peserta[${i}][nis]" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="peserta[${i}][alamat]" rows="2" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Upload Kartu Pelajar</label>
                        <input type="file" class="form-control" name="peserta[${i}][kartu_pelajar]" accept=".jpg,.jpeg,.png,.pdf" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Upload Rapor</label>
                        <input type="file" class="form-control" name="peserta[${i}][rapor]" accept=".jpg,.jpeg,.png,.pdf" required>
                    </div>
                </div>`;
          }
      }

      // Generate Pelatih
      function generatePelatih(jumlah) {
          let container = document.getElementById('formPelatih');
          container.innerHTML = '';
          for (let i = 1; i <= jumlah; i++) {
              container.innerHTML += `
                <div class="card mb-3 p-3">
                    <h6 class="text-muted">Pelatih ${i}</h6>
                    <div class="mb-2">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="pelatih[${i}][nama]" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-control" name="pelatih[${i}][nip]" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="pelatih[${i}][alamat]" rows="2" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Upload KTP</label>
                        <input type="file" class="form-control" name="pelatih[${i}][ktp]" accept=".jpg,.jpeg,.png,.pdf" required>
                    </div>
                </div>`;
          }
      }

      // Event Listener
      document.getElementById('jumlahPeserta').addEventListener('input', function() {
          generatePeserta(this.value);
      });
      document.getElementById('jumlahPelatih').addEventListener('input', function() {
          generatePelatih(this.value);
      });

      // Default awal
      generatePeserta(document.getElementById('jumlahPeserta').value);
      generatePelatih(document.getElementById('jumlahPelatih').value);
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

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      // Grafik Peserta
      const ctx1 = document.getElementById('pesertaChart').getContext('2d');
      new Chart(ctx1, {
          type: 'bar',
          data: {
              labels: ['SMAN 1', 'SMAN 2', 'SMAN 3', 'SMAN 4'],
              datasets: [{
                  label: 'Jumlah Peserta',
                  data: [15, 20, 10, 12],
                  backgroundColor: '#0d6efd'
              }]
          }
      });

      // Grafik Status
      const ctx2 = document.getElementById('statusChart').getContext('2d');
      new Chart(ctx2, {
          type: 'doughnut',
          data: {
              labels: ['Terverifikasi', 'Diproses'],
              datasets: [{
                  data: [58, 12],
                  backgroundColor: ['#198754', '#ffc107']
              }]
          }
      });
  </script>

  <!-- Script Hitung Otomatis -->
  <script>
      document.addEventListener("DOMContentLoaded", function() {
          const inputs = document.querySelectorAll(".nilai-input");
          const totalField = document.getElementById("totalNilai");

          inputs.forEach(input => {
              input.addEventListener("input", () => {
                  let baris = parseFloat(document.querySelector("[name='nilai_baris']").value) || 0;
                  let variasi = parseFloat(document.querySelector("[name='nilai_variasi']").value) || 0;
                  let formasi = parseFloat(document.querySelector("[name='nilai_formasi']").value) || 0;
                  let kompak = parseFloat(document.querySelector("[name='nilai_kompak']").value) || 0;

                  let total = (baris + variasi + formasi + kompak) / 4;
                  totalField.value = total.toFixed(2);
              });
          });
      });
  </script>

  <!-- KElola -->
  <script>
      // Pop up konfirmasi hapus
      document.querySelectorAll('.btn-hapus').forEach(btn => {
          btn.addEventListener('click', function() {
              if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                  alert("Data berhasil dihapus!");
                  // TODO: tambahkan AJAX / form submit hapus
              }
          });
      });
  </script>

  <script>
      function hapusData(nama) {
          Swal.fire({
              title: 'Apakah kamu yakin?',
              text: "Data " + nama + " akan dihapus!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Ya, Hapus!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  Swal.fire(
                      'Terhapus!',
                      'Data berhasil dihapus.',
                      'success'
                  )
                  // TODO: kalau backend sudah siap → panggil route hapus di sini
              }
          })
      }
  </script>


  <!-- Tess -->
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const buttons = document.querySelectorAll('.verify-btn');

          function showToast(message, type = 'success') {
              const container = document.getElementById('toast-container');
              const toastId = 'toast-' + Date.now();
              const toastHTML = `
            <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
              container.insertAdjacentHTML('beforeend', toastHTML);
              const toastEl = document.getElementById(toastId);
              const toast = new bootstrap.Toast(toastEl, {
                  delay: 3000
              });
              toast.show();
          }

          buttons.forEach(btn => {
              btn.addEventListener('click', function() {
                  const teamId = this.dataset.id;
                  const status = this.dataset.status;

                  fetch(`/admin/verifikasi-ajax/${teamId}`, {
                          method: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                              'Content-Type': 'application/json'
                          },
                          body: JSON.stringify({
                              status
                          })
                      })
                      .then(res => res.json())
                      .then(data => {
                          if (data.success) {
                              // Update badge
                              document.getElementById(`status-${teamId}`).innerHTML = data.badge;

                              // Hapus tombol yang sudah dipilih
                              buttons.forEach(b => {
                                  if (b.dataset.id == teamId) b.remove();
                              });

                              showToast('Status tim berhasil diperbarui', 'success');
                          } else {
                              showToast('Gagal memperbarui status', 'danger');
                          }
                      })
                      .catch(err => {
                          console.error(err);
                          showToast('Terjadi kesalahan', 'danger');
                      });
              });
          });
      });
  </script>