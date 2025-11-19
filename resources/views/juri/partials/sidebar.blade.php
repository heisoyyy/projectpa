<!-- Sidebar -->
<div class="sidebar mt-3" id="sidebar">
    <h5 class="text-center mb-4">Menu Juri</h5>

    <ul class="nav flex-column">
        
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ url('/juri') }}"
                class="nav-link {{ Request::is('juri') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>

        <!-- Peserta -->
        <li class="nav-item">
            <a href="{{ url('/juri/peserta-sekolah') }}"
                class="nav-link {{ Request::is('juri/peserta-sekolah*') ? 'active' : '' }}">
                <i class="fa fa-user-check me-2"></i> Peserta
            </a>
        </li>

        <!-- Tim Peserta -->
        <li class="nav-item">
            <a href="{{ url('/juri/tim-sekolah') }}"
                class="nav-link {{ Request::is('juri/tim-sekolah*') ? 'active' : '' }}">
                <i class="fa fa-users me-2"></i> Tim Peserta
            </a>
        </li>

        <!-- Jadwal -->
        <li class="nav-item">
            <a href="{{ url('/juri/jadwal-juri') }}"
                class="nav-link {{ Request::is('juri/jadwal-juri*') ? 'active' : '' }}">
                <i class="fa fa-calendar-alt me-2"></i> Jadwal
            </a>
        </li>

        <!-- Hasil & Nilai -->
        <li class="nav-item">
            <a href="{{ url('/juri/hasil-juri') }}"
                class="nav-link {{ Request::is('juri/hasil-juri*') ? 'active' : '' }}">
                <i class="fa fa-trophy me-2"></i> Hasil & Nilai
            </a>
        </li>

    </ul>
</div>
