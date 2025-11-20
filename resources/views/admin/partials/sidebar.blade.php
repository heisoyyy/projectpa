<!-- Sidebar -->
<div class="sidebar mt-3" id="sidebar">
    <h5 class="text-center mb-4">Menu Peserta</h5>

    <ul class="nav flex-column">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ url('/admin') }}"
                class="nav-link {{ Request::is('admin') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>
        </li>

        <!-- Homepage Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Request::is('admin/kelola-homepage') || Request::is('admin/kelola-informasi') ? 'active' : '' }}"
                href="#" id="homepageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-home me-2"></i>Kelola Homepage
            </a>
            <ul class="dropdown-menu" aria-labelledby="homepageDropdown">
                <li>
                    <a class="dropdown-item {{ Request::is('admin/kelola-homepage') ? 'active' : '' }}"
                        href="{{ url('admin/kelola-homepage') }}">
                        Homepage Home
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ Request::is('admin/kelola-informasi') ? 'active' : '' }}"
                        href="{{ url('admin/kelola-informasi') }}">
                        Homepage Informasi
                    </a>
                </li>
            </ul>
        </li>
        <!-- Verifikasi -->
        <li class="nav-item">
            <a href="{{ route('admin.verifikasi.index') }}"
                class="nav-link {{ Request::is('admin/admin/verifikasi-user*') ? 'active' : '' }}">
                <i class="fa fa-user-check"></i> Aktivisi User
            </a>
        </li>
        <!-- Daftar Peserta -->
        <li class="nav-item">
            <a href="{{ url('admin/daftar-admin') }}"
                class="nav-link {{ Request::is('admin/daftar-admin*') ? 'active' : '' }}">
                <i class="fa fa-users me-2"></i>Daftar Peserta
            </a>
        </li>

        <!-- Pesan -->
        <li class="nav-item">
            <a href="{{ url('/admin/pesan-admin') }}"
                class="nav-link {{ Request::is('admin/pesan-admin*') ? 'active' : '' }}">
                <i class="fa fa-check-circle me-2"></i>Pesan
            </a>
        </li>

        <!-- Jadwal -->
        <li class="nav-item">
            <a href="{{ url('/admin/jadwal-admin') }}"
                class="nav-link {{ Request::is('admin/jadwal-admin*') ? 'active' : '' }}">
                <i class="fa fa-calendar-alt me-2"></i>Jadwal
            </a>
        </li>

        <!-- Hasil & Nilai -->
        <li class="nav-item">
            <a href="{{ url('/admin/hasil-admin') }}"
                class="nav-link {{ Request::is('admin/hasil-admin*') ? 'active' : '' }}">
                <i class="fa fa-trophy me-2"></i>Hasil & Nilai
            </a>
        </li>

        <!-- Laporan -->
        <li class="nav-item">
            <a href="{{ url('/admin/laporan-admin') }}"
                class="nav-link {{ Request::is('admin/laporan-admin*') ? 'active' : '' }}">
                <i class="fa fa-file-export me-2"></i>Laporan
            </a>
        </li>
    </ul>
</div>