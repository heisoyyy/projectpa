<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-red-900 shadow-sm fixed-top">
    <div class="container-fluid">
        <!-- Toggle Button -->
        <button class="btn btn-outline-secondary me-2" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="#">LKBB Komando</a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Messages -->
                <li class="nav-item dropdown me-2">
                    @php
                    $user = auth()->user();
                    $teamId = $user->team->id ?? null;
                    
                    if ($teamId) {
                        // Ambil semua pesan untuk user (all atau specific team)
                        $allPesans = \App\Models\Pesan::forTeam($teamId)->get();
                        
                        // Hitung yang belum dibaca dengan cek pivot table
                        $unreadCount = $allPesans->filter(function($pesan) use ($user) {
                            $pivot = $pesan->receivers()->where('user_id', $user->id)->first();
                            return !$pivot || !$pivot->pivot->is_read;
                        })->count();
                        
                        // Ambil 5 pesan terbaru, urutkan yang belum dibaca dulu
                        $pesans = $allPesans->sortByDesc(function($pesan) use ($user) {
                            $pivot = $pesan->receivers()->where('user_id', $user->id)->first();
                            $isRead = $pivot ? $pivot->pivot->is_read : false;
                            return !$isRead; // Belum dibaca di atas
                        })->take(5);
                    } else {
                        $unreadCount = 0;
                        $pesans = collect([]);
                    }
                    @endphp

                    <a class="nav-link position-relative" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                        @if($unreadCount > 0)
                        <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">
                            {{ $unreadCount }}
                        </span>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="messageDropdown" style="max-width: 350px; min-width: 300px;">
                        <li class="dropdown-header d-flex justify-content-between align-items-center">
                            <span>Pesan Terbaru</span>
                            @if($unreadCount > 0)
                            <span class="badge bg-danger">{{ $unreadCount }} Belum Dibaca</span>
                            @endif
                        </li>

                        @forelse($pesans as $pesan)
                        @php
                        $pivot = $pesan->receivers()->where('user_id', $user->id)->first();
                        $isRead = $pivot ? $pivot->pivot->is_read : false;
                        @endphp
                        <li>
                            <a class="dropdown-item d-flex flex-column {{ $isRead ? 'text-muted' : 'fw-bold' }}" 
                               href="{{ route('user.pesan.read', $pesan->id) }}"
                               style="border-left: 3px solid {{ $isRead ? '#6c757d' : '#dc3545' }}; padding-left: 12px;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <strong class="{{ $isRead ? 'text-muted' : 'text-dark' }}">
                                        {{ $pesan->judul }}
                                    </strong>
                                    @if(!$isRead)
                                    <span class="badge bg-danger ms-2" style="font-size: 0.65rem;">Baru</span>
                                    @endif
                                </div>
                                <small class="text-muted">{{ Str::limit($pesan->isi, 50) }}</small>
                                <small class="text-muted">
                                    <i class="far fa-clock"></i> {{ $pesan->created_at->diffForHumans() }}
                                </small>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @empty
                        <li><span class="dropdown-item text-muted text-center">Tidak ada pesan</span></li>
                        @endforelse

                        <li>
                            <a class="dropdown-item text-center fw-bold text-primary" href="{{ route('user.pesan.index') }}">
                                <i class="fas fa-envelope-open-text"></i> Lihat Semua Pesan
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle me-2"
                            src="{{ Auth::user()->foto_profile
                                ? asset('storage/' . Auth::user()->foto_profile)
                                : asset('assets/a2/img/user.jpg') }}"
                            alt="Foto Profil"
                            style="width: 40px; height: 40px; object-fit: cover;">
                        <span class="d-none d-lg-inline"><b>{{ Auth::user()->nama_sekolah }}</b></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li>
                            <a href="{{ url('user/profile-user') }}"
                                class="dropdown-item {{ Request::is('user/profile-user') ? 'active bg-secondary text-white' : '' }}">
                                <i class="fa fa-user me-2"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('user/setting-user') }}"
                                class="dropdown-item {{ Request::is('user/setting-user') ? 'active bg-secondary text-white' : '' }}">
                                <i class="fa fa-cog me-2"></i>Settings
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fa fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Overlay (mobile) -->
<div class="overlay" id="overlay"></div>