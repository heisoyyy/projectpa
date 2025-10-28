@extends('user.komponen.komponen')

@section('title', 'Detail Pesan')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="rounded p-4 shadow-sm">
                @php
                // Cek status dibaca dari pivot table
                $user = auth()->user();
                $pivot = $pesan->receivers()->where('user_id', $user->id)->first();
                $isRead = $pivot ? $pivot->pivot->is_read : false;
                $readAt = $pivot ? $pivot->pivot->updated_at : null;
                @endphp

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">
                        <i class="fas fa-envelope-open text-primary"></i> 
                        {{ $pesan->judul }}
                    </h4>
                    <a href="{{ route('user.pesan.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Status Badge -->
                <div class="mb-3">
                    @if($isRead)
                    <span class="badge bg-success">
                        <i class="fas fa-check-double"></i> Sudah Dibaca
                    </span>
                    @else
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-envelope"></i> Baru
                    </span>
                    @endif
                    
                    <small class="text-muted ms-3">
                        <i class="far fa-clock"></i> 
                        Dikirim: {{ $pesan->created_at->translatedFormat('d F Y, H:i') }} WIB
                    </small>

                    @if($isRead && $readAt)
                    <small class="text-muted ms-3">
                        <i class="fas fa-eye"></i> 
                        Dibaca: {{ $readAt->translatedFormat('d F Y, H:i') }} WIB
                    </small>
                    @endif
                </div>

                <hr>

                <!-- Info Tujuan -->
                <div class="alert alert-info mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>
                            <strong>Tujuan Pesan:</strong><br>
                            <span class="badge bg-primary">
                                {{ $pesan->tujuan === 'all' ? 'Semua Tim' : 'Tim Tertentu' }}
                            </span>
                            @if($pesan->tujuan !== 'all')
                            <small class="d-block mt-1">
                                {{ $pesan->nama_sekolah_tujuan }}
                            </small>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Isi Pesan -->
                <div class="card border-0 bg-light">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">
                            <i class="fas fa-file-alt"></i> Isi Pesan:
                        </h6>
                        <div style="white-space: pre-line; line-height: 1.8; font-size: 1.05rem;">
                            {{ $pesan->isi }}
                        </div>
                    </div>
                </div>

                <!-- Footer Info -->
                <div class="mt-4 p-3 bg-light rounded">
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> 
                        Pesan ini dikirim oleh 
                        <strong>Panitia LKBB Komando</strong>
                        @if($pesan->tujuan === 'all')
                            sebagai pengumuman untuk semua peserta.
                        @else
                            khusus untuk tim Anda.
                        @endif
                    </small>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('user.pesan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesan
                    </a>
                    
                    @if($isRead)
                    <button type="button" class="btn btn-outline-primary" disabled>
                        <i class="fas fa-check"></i> Sudah Dibaca
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection