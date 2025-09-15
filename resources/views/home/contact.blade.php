@extends('home.komponen.home-ofc')

@section('title', 'LKBB Komando')

@section('content')
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>Kontak</h3>
      </div>
    </div>
  </div>
</div>

<div class="contact-page section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="section-heading">
          <h6>| Kontak LKBB Komando</h6>
          <h2>Hubungi Jika Ada Kendala</h2>
        </div>
        <p>Organisasi Siswa Intra Sekolah (OSIS) SMAN Plus Provinsi Riau merupakan wadah resmi bagi siswa untuk mengembangkan potensi diri, kepemimpinan, serta rasa tanggung jawab di lingkungan sekolah. OSIS terdiri atas beberapa seksi bidang, salah satunya adalah Seksi Bidang Kepribadian Unggul, Wawasan Kebangsaan, dan Bela Negara (BELBANG) yang berfokus pada pembinaan kedisiplinan dan penanaman nilai nasionalisme. Melalui OSIS, SMAN Plus Provinsi Riau secara konsisten menyelenggarakan berbagai kegiatan, termasuk Lomba Ketangkasan Baris-Berbaris (LKBB) Komando sebagai ajang penguatan karakter siswa.</p>
        <div class="row">
          <div class="col-lg-6">
            <div class="item phone">
              <i class="fa fa-phone" style="font-size:52px; color:#800000;"></i>
              <h6>0374 70562<br><span>Nomor Hp</span></h6>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="item email">
              <i class="fa fa-envelope" style="font-size:52px; color:#800000;"></i>
              <h6>info@smanplus-propriau-sch.id<br><span>Email</span></h6>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <form id="contact-form" action="" method="post">
          <div class="row">
            <div class="col-lg-12">
              <fieldset>
                <label for="name">Nama Lengkap</label>
                <input type="name" name="name" id="name" placeholder="Masukan Nama" autocomplete="on" required>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Masukan Email" required="">
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <label for="subject">Subject</label>
                <input type="subject" name="subject" id="subject" placeholder="Masukan Subject" autocomplete="on">
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <label for="pesan">Pesan</label>
                <textarea name="pesan" id="pesan" placeholder="Masukan Pesan"></textarea>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <button type="submit" id="form-submit" class="orange-button">Kirim Pesan</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-12">
        <div id="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8062.54813596318!2d101.39923702907177!3d0.4132533742490759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a873ae3de173%3A0x6596574a06800d8d!2sSMA%20Negeri%20Plus%20Provinsi%20Riau!5e1!3m2!1sen!2sid!4v1755435483166!5m2!1sen!2sid" width="100%" height="500px" frameborder="0" style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);" allowfullscreen=""></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection