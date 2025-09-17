@extends('home.komponen.home-ofc')

@section('title', 'LKBB Komando')

@section('content')
<div class="main-banner">
  <div class="owl-carousel owl-banner">
    @foreach($banners as $banner)
    <div class="item item-{{ $loop->iteration }}"
      style="background-image: url('{{ asset('storage/'.$banner->gambar) }}');">
      <div class="header-text">
        <span class="category">{{ $banner->kategori }} <em>{{ $banner->judul }}</em></span>
        <h2>{!! nl2br(e($banner->sub_judul ?? '')) !!}</h2>
      </div>
    </div>
    @endforeach
  </div>
</div>


<div class="featured section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="left-image">
          <img src="{{ asset('storage/'.$featured->gambar) }}" alt="">
          <a href="#"><img src="{{ asset('assets/images/featured-icon.png') }}" alt="" style="max-width: 60px; padding: 0;"></a>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="section-heading">
          <h6>| {{ $featured->sub_judul }}</h6>
          <h2>{{ $featured->judul }}</h2>
        </div>
        <div class="accordion" id="accordionExample">
          @foreach($accordions as $accordion)
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $accordion->id }}">
              <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $accordion->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $accordion->id }}">
                {{ $accordion->pertanyaan }}
              </button>
            </h2>
            <div id="collapse{{ $accordion->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $accordion->id }}" data-bs-parent="#accordionExample">
              <div class="accordion-body">{!! $accordion->jawaban !!}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-lg-3">
        <div class="info-table">
          <ul>
            @foreach($juaras->take(3) as $index => $juara)
            <li>
              <img src="{{ asset('storage/'.$juara->gambar) }}" alt="" style="max-width: 52px;">
              <h4>{{ $juara->nama_sekolah }}<br><span>Juara {{ $juara->juara }}</span></h4>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="video section"
  style="background-image: url('{{ asset('storage/' . ($videos->first()->background ?? 'images/video-bg.jpg')) }}'); 
            background-repeat: no-repeat; background-size: cover; background-position: center center; 
            padding: 100px 0px 250px 0px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4">
        <div class="section-heading text-center">
          <h6>| Recap Video</h6>
          <h2>LKBB Komando</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="video-content">
  <div class="container">
    <div class="row">
      @foreach($videos as $video)
      <div class="col-lg-10 offset-lg-1">
        <div class="video-frame">
          <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="">
          <a href="{{ $video->link }}" target="_blank"><i class="fa fa-play"></i></a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>


<div class="fun-facts">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="wrapper">
          <div class="row">
            <div class="section-heading text-center">
              <h2>{{ $statistikJudul }}</h2>
            </div>
            @foreach($statistiks as $stat)
            <div class="col-lg-4">
              <div class="counter">
                <h2 class="timer count-title count-number" data-to="{{ $stat->jumlah }}" data-speed="1000"></h2>
                <p class="count-text">{{ $stat->label }}</p>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="section best-deal">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="section-heading">
          <h6>| LKBB 2025 </h6>
          <h2>Juara </h2>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="tabs-content">
          <div class="row">
            <div class="nav-wrapper">
              <ul class="nav nav-tabs" role="tablist">
                @foreach($juaras->take(3) as $index => $juara)
                <li class="nav-item" role="presentation">
                  <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $juara->id }}" data-bs-toggle="tab" data-bs-target="#content-{{ $juara->id }}" type="button" role="tab" aria-controls="content-{{ $juara->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">Juara {{ $juara->juara }}</button>
                </li>
                @endforeach
              </ul>
            </div>
            <div class="tab-content" id="myTabContent">
              @foreach($juaras->take(3) as $index => $juara)
              <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content-{{ $juara->id }}" role="tabpanel" aria-labelledby="tab-{{ $juara->id }}">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="info-table">
                      <div class="card">
                        <div class="item">
                          <p class="label">Nama Sekolah</p>
                          <p class="value">{{ $juara->nama_sekolah }}</p>
                        </div>
                        <div class="divider"></div>
                        <div class="item">
                          <p class="label">Jumlah Tim</p>
                          <p class="value">{{ $juara->jumlah_tim }}</p>
                        </div>
                        <div class="divider"></div>
                        <div class="item">
                          <p class="label">Pelatih</p>
                          <p class="value">{{ $juara->pelatih }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <img src="{{ asset('storage/'.$juara->gambar) }}" alt="">
                  </div>
                  <div class="col-lg-3">
                    <h4>{{ $juara->nama_sekolah }}</h4>
                    <p>{{ $juara->deskripsi }}</p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Pendaftaran & Kontak tetap static --}}
<div class="properties section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4">
        <div class="section-heading text-center">
          <h6>| LKBB Komando 2025</h6>
          <h2>Pendaftaran Dibuka LKBB Komando 2025!</h2>
        </div>
      </div>
    </div>

    <div class="icon-button text-center">
      <a href="{{ url('home/pendaftaran') }}">
        <span class="icon"><i class="fa fa-calendar"></i></span>
        <span class="text">DAFTAR SEKARANG!</span>
      </a>
    </div>
  </div>
</div>

<div class="contact section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4">
        <div class="section-heading text-center">
          <h6>| Kontak</h6>
          <h2>Hubungi Jika ada Kendala</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="contact-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div id="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!..." width="100%" height="500px" frameborder="0" style="border:0; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.15);" allowfullscreen></iframe>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="item phone">
              <i class="fa fa-phone" style="font-size:52px; color:#800000;"></i>
              <br>
              <h6>0374 70562<br><span>Nomor Hp</span></h6>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="item email">
              <i class="fa fa-envelope" style="font-size:52px; color:#800000;"></i>
              <br>
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
                <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Masukan Email" required>
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
    </div>
  </div>
</div>
@endsection