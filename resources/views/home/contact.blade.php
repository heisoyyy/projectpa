@extends('home.komponen.home-ofc')

@section('title', 'LKBB Komando')

@section('content')
<div class="page-heading header-text"
  style="background: url('{{ Storage::url($informasi->background) }}') no-repeat center center/cover;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h3 style="color:#fff; font-weight:700; text-shadow:2px 2px 5px rgba(0,0,0,0.5);">Kontak</h3>
      </div>
    </div>
  </div>
</div>

<div class="contact-page section py-5">
  <div class="container">
    <div class="row align-items-start">
      <!-- Informasi Kontak -->
      <div class="col-lg-6 mb-4">
        <div class="section-heading mb-4">
          <h6 class="text-uppercase text-muted" style="letter-spacing:2px;">| Kontak LKBB Komando</h6>
          <h2 class="fw-bold">Hubungi Jika Ada Kendala</h2>
        </div>

        <p class="mb-4 text-justify">
          Organisasi Siswa Intra Sekolah (OSIS) SMAN Plus Provinsi Riau merupakan wadah resmi bagi siswa untuk mengembangkan potensi diri, kepemimpinan, serta rasa tanggung jawab di lingkungan sekolah. OSIS terdiri atas beberapa seksi bidang, salah satunya adalah Seksi Bidang Kepribadian Unggul, Wawasan Kebangsaan, dan Bela Negara (BELBANG) yang berfokus pada pembinaan kedisiplinan dan penanaman nilai nasionalisme. Melalui OSIS, SMAN Plus Provinsi Riau secara konsisten menyelenggarakan berbagai kegiatan, termasuk Lomba Ketangkasan Baris-Berbaris (LKBB) Komando sebagai ajang penguatan karakter siswa.
        </p>

        <div class="row g-3 text-center">
          <!-- Phone -->
          <div class="col-md-4">
            <div class="contact-item p-4 border rounded shadow-sm h-100 bg-light hover-shadow">
              <i class="fa fa-phone fa-2x mb-2" style="color:#800000;"></i>
              <h6 class="mb-0 fw-bold">0374 70562</h6>
              <small class="text-muted">Nomor HP</small>
            </div>
          </div>

          <!-- Email -->
          <div class="col-md-4">
            <div class="contact-item p-4 border rounded shadow-sm h-100 bg-light hover-shadow">
              <i class="fa fa-envelope fa-2x mb-2" style="color:#800000;"></i>
              <h6 class="mb-0 fw-bold">info@smanplus-propriau-sch.id</h6>
              <small class="text-muted">Email</small>
            </div>
          </div>

          <!-- Instagram -->
          <div class="col-md-4">
            <div class="contact-item p-4 border rounded shadow-sm h-100 bg-light hover-shadow">
              <i class="fa fa-instagram fa-2x mb-2" style="color:#800000;"></i>
              <h6 class="mb-0 fw-bold">@smanplus_propriau</h6>
              <small class="text-muted">Instagram</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Form Kontak -->
      <div class="col-lg-6">
        <form id="contact-form" action="" method="post" class="p-4 border rounded shadow-sm bg-white">
          <div class="row g-3">
            <div class="col-lg-12">
              <fieldset>
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" id="name" placeholder="Masukan Nama" autocomplete="on" required>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukan Email" required>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" placeholder="Masukan Subject" autocomplete="on">
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <label for="pesan">Pesan</label>
                <textarea name="pesan" id="pesan" placeholder="Masukan Pesan"></textarea>
              </fieldset>
            </div>
            <div class="col-lg-12 text-end">
              <button type="submit" id="form-submit" class="orange-button">Kirim Pesan</button>
            </div>
          </div>
        </form>
      </div>

      <!-- Map -->
      <div class="col-lg-12 mt-5">
        <div id="map" class="shadow-sm rounded">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8062.54813596318!2d101.39923702907177!3d0.4132533742490759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a873ae3de173%3A0x6596574a06800d8d!2sSMA%20Negeri%20Plus%20Provinsi%20Riau!5e1!3m2!1sen!2sid!4v1755435483166!5m2!1sen!2sid"
            width="100%"
            height="500"
            style="border:0; border-radius:10px;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection