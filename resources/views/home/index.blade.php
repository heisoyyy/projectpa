@extends('home.komponen.home-ofc')

@section('title', 'LKBB Komando')

@section('content')

{{-- ============================================================
     GLOBAL STYLE
============================================================ --}}
<style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Source+Sans+3:ital,wght@0,300;0,400;0,600;1,400&display=swap');

  :root {
    --clr-primary:   #c0392b;
    --clr-dark:      #111418;
    --clr-mid:       #2c3035;
    --clr-light:     #f4f4f2;
    --clr-muted:     #8a8f98;
    --clr-border:    #e2e2df;
    --clr-card-bg:   #ffffff;
    --font-display:  'Oswald', sans-serif;
    --font-body:     'Source Sans 3', sans-serif;
    --radius:        10px;
    --shadow-sm:     0 2px 10px rgba(0,0,0,.07);
    --shadow-md:     0 6px 24px rgba(0,0,0,.10);
    --transition:    .25s ease;
  }

  body { font-family: var(--font-body); }

  .lk-section-label {
    display: inline-block;
    font-family: var(--font-display);
    font-size: .7rem;
    font-weight: 600;
    letter-spacing: .18em;
    text-transform: uppercase;
    color: var(--clr-primary);
    border-left: 3px solid var(--clr-primary);
    padding-left: .6rem;
    margin-bottom: .6rem;
  }
  .lk-section-title {
    font-family: var(--font-display);
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    font-weight: 700;
    color: var(--clr-dark);
    line-height: 1.15;
    margin-bottom: 0;
  }
</style>


{{-- ============================================================
     1. BANNER — ASLI
============================================================ --}}
<div class="main-banner">
    <div class="owl-carousel owl-banner">
        @foreach ($banners as $banner)
            <div class="item item-{{ $loop->iteration }}"
                style="background-image: url('{{ asset('storage/' . $banner->gambar) }}');">
                <div class="header-text">
                    <span class="category">{{ $banner->kategori }} <em>{{ $banner->judul }}</em></span>
                    <h2>{!! nl2br(e($banner->sub_judul ?? '')) !!}</h2>
                </div>
            </div>
        @endforeach
    </div>
</div>


{{-- ============================================================
     2. FEATURED — ASLI
============================================================ --}}
<div class="featured section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Kolom Gambar -->
            <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
                <div class="left-image position-relative">
                    <img src="{{ asset('storage/' . $featured->gambar) }}" alt=""
                        class="img-fluid rounded shadow-sm">
                    <img src="{{ asset('assets/images/featured-icon.png') }}" alt=""
                        style="max-width: 60px; position: absolute; bottom: 10px; right: 10px;">
                </div>
            </div>

            <!-- Kolom Judul + Accordion -->
            <div class="col-lg-8">
                <div class="section-heading mb-4">
                    <h6 class="mb-2">{{ $featured->sub_judul }}</h6>
                    <h2 class="fw-bold">{{ $featured->judul }}</h2>
                </div>

                <div class="accordion" id="accordionExample">
                    @foreach ($accordions as $accordion)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header" id="heading{{ $accordion->id }}">
                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $accordion->id }}"
                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                    aria-controls="collapse{{ $accordion->id }}">
                                    {{ $accordion->pertanyaan }}
                                </button>
                            </h2>
                            <div id="collapse{{ $accordion->id }}"
                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                aria-labelledby="heading{{ $accordion->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">{!! $accordion->jawaban !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ============================================================
     3. VIDEO SECTION — ASLI
============================================================ --}}
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

<div class="video-content">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($videos as $video)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="video-frame">
                        <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Video Thumbnail" class="video-thumb">
                        <a href="{{ $video->link }}" target="_blank" class="play-btn">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


{{-- ============================================================
     4. FUN FACTS / STATISTIK — DIPERBAIKI
============================================================ --}}
<div class="lk-stats">
  <div class="container">
    <div class="text-center mb-5">
      <span class="lk-section-label">Statistik</span>
      <h2 class="lk-section-title">{{ $statistikJudul }}</h2>
    </div>
    <div class="row justify-content-center g-4">
      @foreach ($statistiks as $stat)
        <div class="col-sm-6 col-md-4">
          <div class="lk-stat-card">
            <div class="lk-stat-card__icon">
              <i class="fa fa-users"></i>
            </div>
            <h2 class="timer count-title count-number lk-stat-card__number"
                data-to="{{ $stat->jumlah }}" data-speed="1500">0</h2>
            <p class="lk-stat-card__label">{{ $stat->label }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<style>
  .lk-stats {
    background: var(--clr-light);
    padding: 72px 0;
  }
  .lk-stat-card {
    background: var(--clr-card-bg);
    border-radius: var(--radius);
    padding: 2rem 1.5rem;
    text-align: center;
    box-shadow: var(--shadow-sm);
    border-top: 3px solid var(--clr-primary);
    transition: transform var(--transition), box-shadow var(--transition);
  }
  .lk-stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
  }
  .lk-stat-card__icon {
    width: 52px; height: 52px;
    border-radius: 50%;
    background: rgba(192,57,43,.1);
    color: var(--clr-primary);
    font-size: 1.3rem;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1rem;
  }
  .lk-stat-card__number {
    font-family: var(--font-display);
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--clr-dark);
    line-height: 1;
    margin-bottom: .4rem;
  }
  .lk-stat-card__label {
    font-size: .88rem;
    font-weight: 600;
    letter-spacing: .05em;
    text-transform: uppercase;
    color: var(--clr-muted);
    margin: 0;
  }
</style>


{{-- ============================================================
     5. JUARA (TABS) — DIPERBAIKI
============================================================ --}}
<div class="lk-juara">
  <div class="container">

    <div class="text-center mb-5">
      <span class="lk-section-label">LKBB 2025</span>
      <h2 class="lk-section-title">Juara</h2>
    </div>

    <!-- Tab Nav -->
    <div class="lk-juara__nav-wrap mb-4">
      <ul class="nav lk-juara__tabs" role="tablist">
        @foreach ($juaras->take(3) as $juara)
          <li class="nav-item" role="presentation">
            <button class="lk-juara__tab-btn {{ $loop->first ? 'active' : '' }}"
                    id="tab-{{ $juara->id }}"
                    data-bs-toggle="tab"
                    data-bs-target="#content-{{ $juara->id }}"
                    type="button" role="tab"
                    aria-controls="content-{{ $juara->id }}"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
              <span class="lk-juara__tab-rank">{{ $loop->iteration }}</span>
              <span class="lk-juara__tab-text">Juara {{ $juara->juara }}</span>
            </button>
          </li>
        @endforeach
      </ul>
    </div>

    <!-- Tab Content -->
    <div class="tab-content" id="myTabContent">
      @foreach ($juaras->take(3) as $juara)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
             id="content-{{ $juara->id }}"
             role="tabpanel"
             aria-labelledby="tab-{{ $juara->id }}">

          <div class="row align-items-stretch g-3">

            <!-- Info Card Kiri -->
            <div class="col-lg-3 d-flex">
              <div class="lk-info-card w-100">
                <div class="lk-info-card__header">
                  <i class="fa fa-trophy me-2"></i> Info Tim
                </div>
                <div class="lk-info-card__body">
                  <div class="lk-info-row">
                    <span class="lk-info-row__label">Tim Sekolah</span>
                    <span class="lk-info-row__value">{{ $juara->nama_sekolah }}</span>
                  </div>
                  <div class="lk-info-row">
                    <span class="lk-info-row__label">Jumlah Anggota</span>
                    <span class="lk-info-row__value">{{ $juara->jumlah_tim }} orang</span>
                  </div>
                  <div class="lk-info-row" style="border-bottom:none;">
                    <span class="lk-info-row__label">Pelatih</span>
                    <span class="lk-info-row__value">{{ $juara->pelatih }}</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Gambar Tengah -->
            <div class="col-lg-5 d-flex">
              <div class="lk-juara__img-wrap w-100">
                <img src="{{ asset('storage/' . $juara->gambar) }}"
                     alt="{{ $juara->nama_sekolah }}"
                     class="lk-juara__img">
                <div class="lk-juara__img-badge">
                  <i class="fa fa-medal me-1"></i> Juara {{ $juara->juara }}
                </div>
              </div>
            </div>

            <!-- Deskripsi Kanan -->
            <div class="col-lg-4 d-flex">
              <div class="lk-info-card w-100">
                <div class="lk-info-card__header">
                  <i class="fa fa-info-circle me-2"></i> Deskripsi
                </div>
                <div class="lk-info-card__body">
                  <div class="lk-info-row">
                    <span class="lk-info-row__label">Nama Sekolah</span>
                    <span class="lk-info-row__value fw-semibold">{{ $juara->nama_sekolah }}</span>
                  </div>
                  <div class="lk-info-row" style="border-bottom:none; flex-direction:column; align-items:flex-start; gap:.4rem;">
                    <span class="lk-info-row__label">Deskripsi</span>
                    <span class="lk-info-row__value lk-desc-text">{{ $juara->deskripsi }}</span>
                  </div>
                </div>
              </div>
            </div>

          </div><!-- /.row -->
        </div><!-- /.tab-pane -->
      @endforeach
    </div><!-- /.tab-content -->

  </div>
</div>

<style>
  .lk-juara {
    background: #fff;
    padding: 72px 0 80px;
  }

  /* Tab nav pill */
  .lk-juara__nav-wrap { display: flex; justify-content: center; }
  .lk-juara__tabs {
    display: inline-flex;
    gap: .5rem;
    background: var(--clr-light);
    padding: .35rem;
    border-radius: 50px;
    border: none;
    list-style: none;
    margin: 0;
  }
  .lk-juara__tab-btn {
    display: flex;
    align-items: center;
    gap: .5rem;
    border: none;
    background: transparent;
    border-radius: 50px;
    padding: .5rem 1.25rem;
    font-family: var(--font-display);
    font-size: .9rem;
    font-weight: 600;
    color: var(--clr-muted);
    cursor: pointer;
    transition: background var(--transition), color var(--transition), box-shadow var(--transition);
  }
  .lk-juara__tab-btn.active,
  .lk-juara__tab-btn:hover {
    background: var(--clr-primary);
    color: #fff;
    box-shadow: 0 4px 12px rgba(192,57,43,.3);
  }
  .lk-juara__tab-rank {
    width: 22px; height: 22px;
    border-radius: 50%;
    background: rgba(255,255,255,.25);
    display: inline-flex; align-items: center; justify-content: center;
    font-size: .75rem; font-weight: 700;
  }

  /* Gambar juara — landscape mengikuti tinggi card kiri/kanan */
  .lk-juara__img-wrap {
    position: relative;
    width: 100%;
    height: 100%;
    min-height: 280px;
    overflow: hidden;
    border-radius: var(--radius);
    box-shadow: var(--shadow-md);
  }
  .lk-juara__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform .4s ease;
  }
  .lk-juara__img-wrap:hover .lk-juara__img { transform: scale(1.04); }
  .lk-juara__img-badge {
    position: absolute;
    bottom: 12px; left: 12px;
    background: var(--clr-primary);
    color: #fff;
    font-family: var(--font-display);
    font-size: .78rem;
    font-weight: 600;
    letter-spacing: .05em;
    text-transform: uppercase;
    padding: .3rem .75rem;
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,.25);
  }

  /* Info card */
  .lk-info-card {
    border: 1px solid var(--clr-border);
    border-radius: var(--radius);
    overflow: hidden;
    background: var(--clr-card-bg);
    box-shadow: var(--shadow-sm);
    display: flex;
    flex-direction: column;
  }
  .lk-info-card__header {
    background: var(--clr-dark);
    color: #fff;
    font-family: var(--font-display);
    font-size: .82rem;
    font-weight: 600;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: .65rem 1rem;
  }
  .lk-info-card__body { padding: .5rem 0; flex: 1; }
  .lk-info-row {
    display: flex;
    flex-direction: column;
    padding: .75rem 1rem;
    border-bottom: 1px solid var(--clr-border);
    gap: .15rem;
  }
  .lk-info-row__label {
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--clr-muted);
  }
  .lk-info-row__value {
    font-size: .93rem;
    color: var(--clr-dark);
    line-height: 1.5;
    word-break: break-word;
  }
  .lk-desc-text {
    font-size: .88rem;
    color: #555;
    line-height: 1.7;
    overflow-y: auto;
    max-height: 220px;
  }

  /* Mobile */
  @media (max-width: 991.98px) {
    .lk-juara__img-wrap {
      height: auto;
      min-height: unset;
      aspect-ratio: 16 / 9;
    }
    .lk-juara__tabs {
      flex-wrap: wrap;
      border-radius: var(--radius);
    }
  }
</style>


{{-- ============================================================
     6. PENDAFTARAN — DIPERBAIKI
============================================================ --}}
<div class="lk-cta">
  <div class="container">
    <div class="lk-cta__inner">
      <div class="lk-cta__text">
        <span class="lk-section-label" style="color:rgba(255,255,255,.65); border-color:rgba(255,255,255,.4);">LKBB Komando 2025</span>
        <h2 class="lk-section-title" style="color:#fff; margin-top:.3rem;">Pendaftaran LKBB Komando 2025!</h2>
      </div>

      @php
        $pendaftaran = \App\Models\Setting::where('key', 'pendaftaran_enabled')->first();
      @endphp

      @if ($pendaftaran && $pendaftaran->value == '1')
        <a href="{{ url('home/pendaftaran') }}" class="lk-cta__btn">
          <i class="fa fa-calendar me-2"></i> Daftar Sekarang
        </a>
      @else
        <span class="lk-cta__btn lk-cta__btn--disabled">
          <i class="fa fa-ban me-2"></i> Pendaftaran Ditutup
        </span>
      @endif
    </div>
  </div>
</div>

<style>
  .lk-cta {
    background: linear-gradient(135deg, var(--clr-dark) 0%, var(--clr-mid) 50%, var(--clr-primary) 100%);
    padding: 64px 0;
  }
  .lk-cta__inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    flex-wrap: wrap;
  }
  .lk-cta__btn {
    display: inline-flex;
    align-items: center;
    background: #fff;
    color: var(--clr-primary);
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    text-decoration: none;
    padding: .85rem 2.2rem;
    border-radius: 50px;
    white-space: nowrap;
    box-shadow: 0 6px 20px rgba(0,0,0,.25);
    transition: transform var(--transition), box-shadow var(--transition);
    flex-shrink: 0;
  }
  .lk-cta__btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(0,0,0,.3);
    color: var(--clr-primary);
  }
  .lk-cta__btn--disabled {
    background: rgba(255,255,255,.15);
    color: rgba(255,255,255,.5);
    cursor: not-allowed;
    box-shadow: none;
  }
  .lk-cta__btn--disabled:hover { transform: none; }

  @media (max-width: 767px) {
    .lk-cta__inner { flex-direction: column; text-align: center; }
    .lk-cta__btn { width: 100%; justify-content: center; }
  }
</style>

@endsection
