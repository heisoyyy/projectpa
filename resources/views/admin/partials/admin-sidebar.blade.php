<div class="sidebar pe-4 pb-3 d-flex flex-column" style="min-height: 100vh;">
    <nav class="navbar bg-light navbar-light flex-column flex-grow-1">
        <a href="{{ url('/admin') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="">LKBB KOMANDO</h3>
        </a>

        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets/a2/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Admin</h6>
            </div>
        </div>

        <div class="navbar-nav w-100 flex-grow-1">
            {{-- Dashboard --}}
            <a href="{{ url('/admin') }}"
               class="nav-item nav-link {{ Request::is('admin') ? 'active' : '' }}">
               <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            {{-- Kelola Homepage --}}
            <a href="{{ url('admin/kelola-homepage') }}"
               class="nav-item nav-link {{ Request::is('admin/kelola-homepage*') ? 'active' : '' }}">
               <i class="fa fa-home me-2"></i>Kelola Homepage
            </a>

            {{-- Daftar Peserta --}}
            <a href="{{ url('admin/daftar-admin') }}"
               class="nav-item nav-link {{ Request::is('admin/daftar-admin*') ? 'active' : '' }}">
               <i class="fa fa-users me-2"></i>Daftar Peserta
            </a>

            {{-- Pesan --}}
            <a href="{{ url('/admin/pesan-admin') }}"
               class="nav-item nav-link {{ Request::is('admin/pesan-admin*') ? 'active' : '' }}">
               <i class="fa fa-check-circle me-2"></i>Pesan
            </a>

            {{-- Jadwal --}}
            <a href="{{ url('/admin/jadwal-admin') }}"
               class="nav-item nav-link {{ Request::is('admin/jadwal-admin*') ? 'active' : '' }}">
               <i class="fa fa-calendar-alt me-2"></i>Jadwal
            </a>

            {{-- Input Nilai & Hasil --}}
            <a href="{{ url('/admin/hasil-admin') }}"
               class="nav-item nav-link {{ Request::is('admin/hasil-admin*') ? 'active' : '' }}">
               <i class="fa fa-trophy me-2"></i>Hasil & Nilai
            </a>

            {{-- Laporan --}}
            <a href="{{ url('/admin/laporan-admin') }}"
               class="nav-item nav-link {{ Request::is('admin/laporan-admin*') ? 'active' : '' }}">
               <i class="fa fa-file-export me-2"></i>Laporan
            </a>

            {{-- Kelola Akun --}}
            <a href="{{ url('/admin/profile-admin') }}"
               class="nav-item nav-link {{ Request::is('admin/profile-admin*') ? 'active' : '' }}">
               <i class="fa fa-user-cog me-2"></i>Akun Admin
            </a>
        </div>

        {{-- Logout di bawah --}}
        <div class="navbar-nav w-100 mt-auto">
            <form method="POST" action="">
                @csrf
                <button type="submit" class="nav-item nav-link border-0 bg-transparent text-start w-100">
                    <i class="fa fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>
</div>
