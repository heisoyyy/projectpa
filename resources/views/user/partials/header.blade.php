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
                    $teamId = auth()->user()->team->id ?? null;
                    $unreadCount = $teamId ? \App\Models\Pesan::forTeam($teamId)->count() : 0;
                    $pesans = $teamId
                    ? \App\Models\Pesan::forTeam($teamId)->latest()->take(5)->get()
                    : collect([]);
                    @endphp

                    <a class="nav-link position-relative" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                        @if($unreadCount > 0)
                        <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">
                            {{ $unreadCount }}
                        </span>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="messageDropdown">
                        <li class="dropdown-header">Pesan Terbaru</li>

                        @forelse($pesans as $pesan)
                        <li>
                            <a class="dropdown-item d-flex flex-column" href="{{ route('user.pesan.read', $pesan->id) }}">
                                <strong>{{ $pesan->judul }}</strong>
                                <small class="text-muted">{{ Str::limit($pesan->isi, 50) }}</small>
                                <small class="text-muted">{{ $pesan->created_at->diffForHumans() }}</small>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @empty
                        <li><span class="dropdown-item text-muted">Tidak ada pesan</span></li>
                        @endforelse

                        <li>
                            <a class="dropdown-item text-center fw-bold" href="{{ route('user.pesan.index') }}">
                                Lihat Semua Pesan
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