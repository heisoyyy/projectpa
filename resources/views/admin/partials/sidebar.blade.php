  <!-- Sidebar -->
  <div class="sidebar mt-3" id="sidebar">
      <h5 class="text-center mb-4">Menu Peserta</h5>

      <ul class="nav flex-column">
          <li class="nav-item">
              {{-- Dashboard --}}
              <a href="{{ url('/admin') }}"
                  class="nav-item nav-link {{ Request::is('admin') ? 'active' : '' }}">
                  <i class="fa fa-tachometer-alt me-2"></i>Dashboard
              </a>
          </li>
          <li class="nav-item">
              {{-- Kelola Homepage --}}
              <a href="{{ url('admin/homepage') }}"
                  class="nav-item nav-link {{ Request::is('admin/homepage*') ? 'active' : '' }}">
                  <i class="fa fa-home me-2"></i>Kelola Homepage
              </a>
          </li>
          <li class="nav-item">
              {{-- Daftar Peserta --}}
              <a href="{{ url('admin/daftar-admin') }}"
                  class="nav-item nav-link {{ Request::is('admin/daftar-admin*') ? 'active' : '' }}">
                  <i class="fa fa-users me-2"></i>Daftar Peserta
              </a>
          </li>
          <li class="nav-item">
              {{-- Pesan --}}
              <a href="{{ url('/admin/pesan-admin') }}"
                  class="nav-item nav-link {{ Request::is('admin/pesan-admin*') ? 'active' : '' }}">
                  <i class="fa fa-check-circle me-2"></i>Pesan
              </a>
          </li>
          <li class="nav-item">
              {{-- Jadwal --}}
              <a href="{{ url('/admin/jadwal-admin') }}"
                  class="nav-item nav-link {{ Request::is('admin/jadwal-admin*') ? 'active' : '' }}">
                  <i class="fa fa-calendar-alt me-2"></i>Jadwal
              </a>
          </li>
          <li class="nav-item">
              {{-- Input Nilai & Hasil --}}
              <a href="{{ url('/admin/hasil-admin') }}"
                  class="nav-item nav-link {{ Request::is('admin/hasil-admin*') ? 'active' : '' }}">
                  <i class="fa fa-trophy me-2"></i>Hasil & Nilai
              </a>
          </li>
          <li class="nav-item">
              {{-- Laporan --}}
              <a href="{{ url('/admin/laporan-admin') }}"
                  class="nav-item nav-link {{ Request::is('admin/laporan-admin*') ? 'active' : '' }}">
                  <i class="fa fa-file-export me-2"></i>Laporan
              </a>
          </li>
      </ul>
  </div>