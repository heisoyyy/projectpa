<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-red-900 shadow-sm fixed-top">
    <div class="container-fluid">
        <!-- Toggle Button -->
        <button class="btn btn-outline-secondary me-2" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="{{ url('/juri') }}">OSIS SMAN PLUS</a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
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
                            <a href="{{ url('/juri/profile-juri') }}"
                                class="dropdown-item {{ Request::is('juri/profile-juri*') ? 'active' : '' }}">
                                <i class="fa fa-user me-2"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/juri/setting-juri') }}"
                                class="dropdown-item {{ Request::is('/juri/setting-juri*') ? 'active' : '' }}">
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