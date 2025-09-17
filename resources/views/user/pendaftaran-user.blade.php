@extends('user.komponen.komponen')

@section('title','Daftar Peserta')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-10">
            <div class="rounded h-100 p-4 shadow-sm">
                <h6 class="mb-4">Form Pendaftaran Tim LKBB Komando</h6>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @php
                $team = Auth::check() ? Auth::user()->team : null;
                @endphp

                @if($team)
                <div class="alert alert-info">
                    Anda sudah melakukan pendaftaran tim. Gunakan tombol <strong>Cek</strong> atau <strong>Ubah</strong>.
                </div>
                @endif

                <form action="{{ $team ? route('user.pendaftaran.update', $team->id) : route('user.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($team) @method('PUT') @endif

                    <div class="mb-3">
                        <h6 class="form-label">Nama Tim</h6>
                        <input type="text" class="form-control" value="{{ Auth::user()->nama_sekolah }}" readonly>
                    </div>

                    <div class="mb-3">
                        <h6 class="form-label">Jumlah Peserta</h6>
                        <input type="number" id="jumlahPeserta" class="form-control" min="1" max="30" value="{{ $team ? $team->members->where('role','peserta')->count() : 0 }}" {{ $team ? 'disabled' : '' }}>
                    </div>
                    <div id="formPeserta"></div>

                    <div class="mb-3">
                        <h6 class="form-label">Jumlah Pelatih</h6>
                        <input type="number" id="jumlahPelatih" class="form-control" min="1" max="2" value="{{ $team ? $team->members->where('role','pelatih')->count() : 0 }}" {{ $team ? 'disabled' : '' }}>
                    </div>
                    <div id="formPelatih"></div>

                    <div class="text-end mt-3">
                        @if(!$team)
                        <button type="submit" class="btn btn-light"><i class="fa fa-paper-plane"></i> Daftar</button>
                        @endif
                        @if($team)
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahTimModal"><i class="fa fa-edit"></i> Ubah</button>
                        @endif
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#cekTimModal"><i class="fa fa-eye"></i> Cek</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('user.modals.modal_cek')
@include('user.modals.modal_ubah')
@endsection