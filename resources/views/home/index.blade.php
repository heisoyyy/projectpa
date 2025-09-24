@extends('home.komponen.home-ofc')

@section('title', 'LKBB Komando')

@section('content')
<div class="main-banner">
  <div class="owl-carousel owl-banner">
    @foreach($banners as $banner)
    <div class="item item-{{ $loop->iteration }}"
      style="
      background-image: url('{{ asset('storage/'.$banner->gambar) }}'); 
      ">
      <div class="header-text">
        <span class="category">{{ $banner->kategori }} <em>{{ $banner->judul }}</em></span>
        <h2>{!! nl2br(e($banner->sub_judul ?? '')) !!}</h2>
      </div>s
    </div>
    @endforeach
  </div>
</div>


<div class="featured section">
  <div class="container">
    <div class="row align-items-center">
      <!-- Kolom Gambar -->
      <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
        <div class="left-image position-relative">
          <img src="{{ asset('storage/'.$featured->gambar) }}" alt="" class="img-fluid rounded shadow-sm">
          <img src="{{ asset('assets/images/featured-icon.png') }}" alt="" style="max-width: 60px; position: absolute; bottom: 10px; right: 10px;">
        </div>
      </div>

      <!-- Kolom Judul + Accordion -->
      <div class="col-lg-8">
        <div class="section-heading mb-4">
          <h6 class="mb-2">{{ $featured->sub_judul }}</h6>
          <h2 class="fw-bold">{{ $featured->judul }}</h2>
        </div>

        <div class="accordion" id="accordionExample">
          @foreach($accordions as $accordion)
          <div class="accordion-item mb-2">
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
    </div>
  </div>
</div>


<!-- Video Section -->
<div class="video section"
  style="background-image: url('{{ asset('storage/' . ($videos->first()->background ?? 'images/video-bg.jpg')) }}');">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="section-heading">
          <h6>Recap Video</h6>
          <h2>LKBB Komando</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Video Content -->
<div class="video-content">
  <div class="container">
    <div class="row justify-content-center">
      @foreach($videos as $video)
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="video-frame">
          <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="Video Thumbnail" class="video-thumb">
          <a href="{{ $video->link }}" target="_blank" class="play-btn">
            <i class="fa fa-play"></i>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<!-- Fun Facts Section -->
<div class="fun-facts section">
  <div class="container">
    <div class="section-heading text-center mb-4">
      <h2>{{ $statistikJudul }}</h2>
    </div>
    <div class="row justify-content-center g-4"> <!-- g-4 untuk jarak antar kolom -->
      @foreach($statistiks as $stat)
      <div class="col-sm-6 col-md-4">
        <div class="counter p-4 text-center bg-white rounded shadow-sm h-100">
          <i class="fa fa-users fa-2x mb-3"></i> <!-- Icon people -->
          <div class="counter-content">
            <h2 class="timer count-title count-number" data-to="{{ $stat->jumlah }}" data-speed="1500"></h2>
            <p class="count-text">{{ $stat->label }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>



<div class="section best-deal">
  <div class="container">
    <!-- Section Heading -->
    <div class="section-heading">
      <h6>LKBB 2025</h6>
      <h2>Juara</h2>
    </div>

    <!-- Tabs -->
    <div class="row mt-4">
      <div class="col-lg-12">
        <div class="tabs-content">
          <div class="nav-wrapper mb-3">
            <ul class="nav nav-tabs" role="tablist">
              @foreach($juaras->take(3) as $index => $juara)
              <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                  id="tab-{{ $juara->id }}"
                  data-bs-toggle="tab"
                  data-bs-target="#content-{{ $juara->id }}"
                  type="button"
                  role="tab"
                  aria-controls="content-{{ $juara->id }}"
                  aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                  Juara {{ $juara->juara }}
                </button>
              </li>
              @endforeach
            </ul>
          </div>

          <!-- Tab Content -->
          <div class="tab-content" id="myTabContent">
            @foreach($juaras->take(3) as $index => $juara)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
              id="content-{{ $juara->id }}"
              role="tabpanel"
              aria-labelledby="tab-{{ $juara->id }}">
              <div class="row align-items-center my-4">

                <!-- Info Card -->
                <div class="col-lg-3 mb-3 mb-lg-0">
                  <div class="info-table">
                    <div class="card p-3 h-100">
                      <div class="item mb-2">
                        <p class="label">Nama Sekolah</p>
                        <p class="value">{{ $juara->nama_sekolah }}</p>
                      </div>
                      <div class="divider mb-2"></div>
                      <div class="item mb-2">
                        <p class="label">Jumlah Tim</p>
                        <p class="value">{{ $juara->jumlah_tim }}</p>
                      </div>
                      <div class="divider mb-2"></div>
                      <div class="item">
                        <p class="label">Pelatih</p>
                        <p class="value">{{ $juara->pelatih }}</p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Image -->
                <div class="col-lg-6 mb-3 mb-lg-0 text-center">
                  <img src="{{ asset('storage/'.$juara->gambar) }}" alt="{{ $juara->nama_sekolah }}" class="img-fluid rounded">
                </div>

                <!-- Description -->
                <div class="col-lg-3">
                  <div class="info-table">
                    <div class="card p-3 h-100">
                      <div class="item mb-2">
                        <p class="label">Nama Sekolah</p>
                        <p class="value">{{ $juara->nama_sekolah }}</p>
                      </div>
                      <div class="item mb-2">
                        <p class="label">Deskripsi</p>
                        <p class="value">{{ $juara->deskripsi }}</p>
                      </div>
                      
                    </div>
                  </div>
                </div>

              </div> <!-- row -->
            </div> <!-- tab-pane -->
            @endforeach
          </div> <!-- tab-content -->

        </div> <!-- tabs-content -->
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
          <h6>LKBB Komando 2025</h6>
          <h2>Pendaftaran LKBB Komando 2025!</h2>
        </div>
      </div>
    </div>

    @php
    $pendaftaran = \App\Models\Setting::where('key','pendaftaran_enabled')->first();
    @endphp

    @if($pendaftaran && $pendaftaran->value == '1')
    <div class="icon-button text-center">
      <a href="{{ url('home/pendaftaran') }}">
        <span class="icon"><i class="fa fa-calendar"></i></span>
        <span class="text">DAFTAR SEKARANG!</span>
      </a>
    </div>
    @else
    <div class="icon-button text-center text-muted">
      <span class="icon"><i class="fa fa-ban"></i></span>
      <span class="text">Pendaftaran Ditutup</span>
    </div>
    @endif
  </div>
</div>
@endsection