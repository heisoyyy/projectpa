$(document).ready(function() {

    let toastEl = document.getElementById('centerToast');
    let toast = new bootstrap.Toast(toastEl, { delay: 7000 });

    // Fungsi tampilkan toast
    function tampilToast(message, type) {
        toastEl.className = `toast align-items-center border-0 shadow-lg text-bg-${type}`;
        toastEl.querySelector('.toast-body').innerHTML = message;
        toast.show();
    }

    // --- Cek Dokumen ---
    function cekDokumen() {
        let semuaHijau = true;

        $('.col-lg-4.c p span.badge').each(function() {
            if(!$(this).hasClass('bg-success')) {
                semuaHijau = false;
                return false;
            }
        });

        if(semuaHijau) {
            tampilToast('<i class="fa fa-check-circle"></i> Semua dokumen lengkap. Tunggu verifikasi panitia.', 'success');
        } else {
            tampilToast('<i class="fa fa-exclamation-circle"></i> Beberapa dokumen belum lengkap. Lengkapi segera!', 'danger');
        }
    }

    // --- Cek Status Tim dengan jeda 3 menit ---
    function cekStatusTim() {
        let statusBadge = $('.col-lg-12 .me-4.mb-2 span.badge').first();

        if(statusBadge.hasClass('bg-success')) {
            setTimeout(function() {
                tampilToast('<i class="fa fa-check-circle"></i> Status tim Anda sudah terverifikasi oleh panitia.', 'success');
            }, 180000); // 3 menit
        }
    }

    // Jalankan saat halaman siap
    cekDokumen();
    cekStatusTim();

    // Cek berkala tiap 10 detik
    setInterval(function() {
        cekDokumen();
        cekStatusTim();
    }, 10000);

});
