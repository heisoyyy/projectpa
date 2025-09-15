<div class="sidebar pe-4 pb-3 d-flex flex-column" style="min-height: 100vh;">
    <nav class="navbar bg-light navbar-light flex-column flex-grow-1">
        {{-- Brand --}}
        <a href="{{ url('/user') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="">LKBB KOMANDO</h3>
        </a>

        {{-- Profil User --}}
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle"
                    src="{{ Auth::user()->foto_profile 
            ? asset('storage/' . Auth::user()->foto_profile) 
            : asset('assets/a2/img/user.jpg') }}"
                    alt="Foto Profil"
                    style="width: 40px; height: 40px; object-fit: cover;">

                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Peserta</h6>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <div class="navbar-nav w-100 flex-grow-1">
            {{-- Dashboard --}}
            <a href="{{ url('/user') }}"
                class="nav-item nav-link {{ Request::is('user') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            {{-- Pendaftaran --}}
            <a href="{{ url('user/pendaftaran-user') }}"
                class="nav-item nav-link {{ Request::is('user/pendaftaran-user*') ? 'active' : '' }}">
                <i class="fa fa-keyboard me-2"></i>Pendaftaran
            </a>

            {{-- Jadwal --}}
            <a href="{{ url('/user/jadwal-user') }}"
                class="nav-item nav-link {{ Request::is('user/jadwal-user*') ? 'active' : '' }}">
                <i class="fa fa-calendar-alt me-2"></i>Jadwal
            </a>

            {{-- Hasil --}}
            <a href="{{ url('/user/hasil-user') }}"
                class="nav-item nav-link {{ Request::is('user/hasil-user*') ? 'active' : '' }}">
                <i class="fa fa-trophy me-2"></i>Hasil
            </a>
        </div>

        {{-- Logout di bawah --}}
        <div class="navbar-nav w-100 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item nav-link border-0 bg-transparent text-start w-100">
                    <i class="fa fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>
</div>