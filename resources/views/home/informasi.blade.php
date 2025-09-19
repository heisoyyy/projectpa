@extends('home.komponen.home-ofc')

@section('title', 'LKBB Komando - Informasi')

@section('content')

<!-- Page Heading -->
<div class="page-heading header-text"
  style="background: url('{{ Storage::url($informasi->background) }}') no-repeat center center/cover;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center text-white">
        <h3>{{ $informasi->title }}</h3>
        <p>{{ $informasi->description }}</p>
      </div>
    </div>
  </div>
</div>


<!-- History LKBB Komando -->
<div class="section properties">
  <div class="container">
    <h4 class="mb-4 text-center">Peserta LKBB Komando</h4>

    <!-- Filter by Kota -->
    <ul class="properties-filter">
      <li><a class="is_active" data-filter="*">Semua Kota</a></li>
      @foreach($kotas as $kota)
      <li><a data-filter=".{{ \Illuminate\Support\Str::slug($kota) }}">{{ $kota }}</a></li>
      @endforeach
    </ul>

    <!-- Grid History -->
    <div class="row properties-box" id="isotope-grid">
      @foreach($allHistory as $item)
      <div class="col-lg-4 col-md-6 properties-items mb-30 {{ \Illuminate\Support\Str::slug($item->kota) }}">
        <div class="item">
          <a href="{{ Storage::url($item->image) }}" target="_blank">
            <img src="{{ Storage::url($item->image) }}"
              alt="{{ $item->nama_sekolah }}"
              class="img-fluid"
              style="height:200px;object-fit:cover;">
          </a>
          <span class="category">{{ $item->kota }}</span>
          <h4>{{ $item->nama_sekolah }}</h4>
          <p>{{ $item->deskripsi }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>



<!-- Biodata + Dokumen -->
<div class="section biodata-dokumen my-5">
  <div class="container">
    <div class="row">

      <!-- Kepala Sekolah -->
      @if($biodata->count() > 0)
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100 text-center shadow-sm biodata-card">
          <img src="{{ Storage::url($biodata[0]->foto) }}" class="card-img-top" alt="{{ $biodata[0]->nama }}">
          <div class="card-body">
            <h5 class="card-title">Kepala Sekolah</h5>
            <p class="fw-bold mb-1">{{ $biodata[0]->nama }}</p>
            <small class="text-muted">{{ $biodata[0]->deskripsi }}</small>
          </div>
        </div>
      </div>
      @endif

      <!-- Dokumen Tengah -->
      <div class="col-lg-6 mb-4">
        <h4 class="mb-4 text-center fw-bold">Dokumen & Panduan</h4>
        <div class="row g-3">
          @foreach($dokumen as $doc)
          <div class="col-md-6">
            <div class="card text-center h-100 dokumen-card">
              <img src="{{ Storage::url($doc->thumbnail) }}" class="card-img-top" alt="{{ $doc->judul }}">
              <div class="card-body">
                <h6 class="card-title fw-bold">{{ $doc->judul }}</h6>
                <a href="{{ Storage::url($doc->file) }}" class="btn btn-primary btn-sm" target="_blank">Download</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Ketua OSIS -->
      @if($biodata->count() > 1)
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100 text-center shadow-sm biodata-card">
          <img src="{{ Storage::url($biodata[1]->foto) }}" class="card-img-top" alt="{{ $biodata[1]->nama }}">
          <div class="card-body">
            <h5 class="card-title">Ketua OSIS</h5>
            <p class="fw-bold mb-1">{{ $biodata[1]->nama }}</p>
            <small class="text-muted">{{ $biodata[1]->deskripsi }}</small>
          </div>
        </div>
      </div>
      @endif

    </div>
  </div>
</div>

@endsection