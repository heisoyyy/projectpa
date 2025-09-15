<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="{{ url('/') }}" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler btn-light flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="d-none d-md-flex ms-4 align-items-center">
        <h5 class="mb-0 fw-bold"> </h5>
    </div>
    <div class="navbar-nav align-items-center ms-auto">

        <!-- Notifikasi Pesan -->
        <li class="nav-item dropdown">
            <a class="nav-link position-relative" href="#" id="pesanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-envelope"></i>
                @php
                $unreadCount = auth()->user()
                ->team
                ? \App\Models\Pesan::forTeam(auth()->user()->team->id)->count()
                : 0;
                @endphp
                @if($unreadCount > 0)
                <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">
                    {{ $unreadCount }}
                </span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="pesanDropdown" style="width: 300px; max-height: 400px; overflow-y:auto;">
                <li class="dropdown-header">Pesan Terbaru</li>
                @php
                $pesans = auth()->user()->team
                ? \App\Models\Pesan::forTeam(auth()->user()->team->id)->latest()->take(5)->get()
                : collect([]);
                @endphp

                @forelse($pesans as $pesan)
                <li>
                    <a class="dropdown-item d-flex align-items-start" href="{{ route('user.pesan.read', $pesan->id) }}">
                        <div>
                            <strong>{{ $pesan->judul }}</strong><br>
                            <small class="text-muted">{{ Str::limit($pesan->isi, 50) }}</small><br>
                            <small class="text-muted">{{ $pesan->created_at->diffForHumans() }}</small>
                        </div>
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



        {{-- Profile --}}
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle"
                    src="{{ Auth::user()->foto_profile 
            ? asset('storage/' . Auth::user()->foto_profile) 
            : asset('assets/a2/img/user.jpg') }}"
                    alt="Foto Profil"
                    style="width: 40px; height: 40px; object-fit: cover;">

                <span class="d-none d-lg-inline-flex"><b>{{ Auth::user()->nama_sekolah }}</b></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="{{ url('user/profile-user') }}"
                    class="dropdown-item {{ Request::is('user/profile-user') ? 'active bg-secondary' : '' }}">
                    Profile
                </a>
                <a href="{{ url('user/setting-user') }}"
                    class="dropdown-item {{ Request::is('user/setting-user') ? 'active bg-secondary' : '' }}">
                    Settings
                </a>
            </div>

        </div>
    </div>
</nav>