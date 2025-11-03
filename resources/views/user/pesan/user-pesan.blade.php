@extends('user.komponen.komponen')

@section('title', 'Pesan')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="rounded p-4 shadow-sm">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">
                            Kotak Pesan
                        </h4>
                        @if($unreadCount > 0)
                        <small class="text-muted">
                            Anda memiliki <span class="badge bg-danger">{{ $unreadCount }}</span> pesan belum dibaca
                        </small>
                        @endif
                    </div>
                    
                    @if($unreadCount > 0)
                    <form action="{{ route('user.pesan.markAllRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">
                            Tandai Semua Dibaca
                        </button>
                    </form>
                    @endif
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <!-- List Pesan -->
                <div class="list-group">
                    @forelse($pesans as $pesan)
                    @php
                    // Cek status dibaca dari pivot table
                    $user = auth()->user();
                    $pivot = $pesan->receivers()->where('user_id', $user->id)->first();
                    $isRead = $pivot ? $pivot->pivot->is_read : false;
                    $readAt = $pivot ? $pivot->pivot->updated_at : null;
                    @endphp
                    
                    <a href="{{ route('user.pesan.read', $pesan->id) }}" 
                       class="list-group-item list-group-item-action {{ $isRead ? '' : 'list-group-item-warning' }}">
                        
                        <div class="d-flex w-100 justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-1">
                                    @if(!$isRead)
                                    <span class="badge bg-danger me-2">Baru</span>
                                    @else
                                    <i class="fas fa-envelope-open text-muted me-2"></i>
                                    @endif
                                    
                                    <h6 class="mb-0 {{ $isRead ? 'text-muted' : 'fw-bold' }}">
                                        {{ $pesan->judul }}
                                    </h6>
                                </div>
                                
                                <p class="mb-1 text-muted">
                                    {{ Str::limit($pesan->isi, 100) }}
                                </p>
                                
                                <div class="d-flex flex-wrap gap-2">
                                    <small class="text-muted">
                                        <i class="far fa-clock"></i> 
                                        {{ $pesan->created_at->diffForHumans() }}
                                    </small>
                                    
                                    @if($isRead && $readAt)
                                    <small class="text-muted">
                                        <i class="fas fa-eye"></i> 
                                        Dibaca {{ $readAt->diffForHumans() }}
                                    </small>
                                    @endif

                                    <small class="badge bg-info">
                                        <i class="fas fa-users"></i>
                                        {{ $pesan->tujuan === 'all' ? 'Semua Tim' : 'Tim Tertentu' }}
                                    </small>
                                </div>
                            </div>
                            
                            <div class="ms-3">
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-5">
                        <p class="text-muted mt-3">Tidak ada pesan</p>
                        @if(!auth()->user()->team)
                        <small class="text-muted">Silakan daftar tim terlebih dahulu untuk menerima pesan.</small>
                        @endif
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($pesans->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $pesans->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection