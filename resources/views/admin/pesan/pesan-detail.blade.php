@extends('user.komponen.komponen')

@section('title', 'Detail Pesan')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded p-4 shadow-sm">
                <h4 class="mb-3">{{ $pesan->judul }}</h4>
                <p class="text-muted">Dikirim: {{ $pesan->created_at->format('d-m-Y H:i') }}</p>
                <hr>
                <p>{{ $pesan->isi }}</p>

                <!-- Tombol kembali ke daftar pesan -->
                <a href="{{ route('user.pesan.index') }}" class="btn btn-secondary mt-3">
                    ← Kembali ke Pesan
                </a>
            </div>
        </div>
    </div>  
</div>
@endsection
