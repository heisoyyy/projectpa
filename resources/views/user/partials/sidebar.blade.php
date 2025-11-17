  <!-- Sidebar -->
  <div class="sidebar mt-3" id="sidebar">
      <h5 class="text-center mb-4">Menu Peserta</h5>

      <ul class="nav flex-column">
          <li class="nav-item">
              {{-- Dashboard --}}
              <a href="{{ url('/user') }}"
                  class="nav-item nav-link {{ Request::is('user') ? 'active' : '' }}">
                  <i class="fa fa-tachometer-alt me-2"></i>Dashboard
              </a>
          </li>
          <li class="nav-item">
              {{-- Pesan --}}
              <a href="{{ url('/user/pesan') }}"
                  class="nav-item nav-link {{ Request::is('user/pesan') ? 'active' : '' }}">
                  <i class="fa fa-check-circle me-2"></i>Pesan
              </a>
          </li>
          <li class="nav-item">
              {{-- Pendaftaran --}}
              <a href="{{ url('user/pendaftaran-user') }}"
                  class="nav-item nav-link {{ Request::is('user/pendaftaran-user*') ? 'active' : '' }}">
                  <i class="fa fa-keyboard me-2"></i>Pendaftaran
              </a>
          </li>
          <li class="nav-item">
              {{-- Jadwal --}}
              <a href="{{ url('/user/jadwal-user') }}"
                  class="nav-item nav-link {{ Request::is('user/jadwal-user*') ? 'active' : '' }}">
                  <i class="fa fa-calendar-alt me-2"></i>Jadwal
              </a>
          </li>
          <li class="nav-item">
              {{-- Hasil --}}
              <a href="{{ url('/user/hasil-user') }}"
                  class="nav-item nav-link {{ Request::is('user/hasil-user*') ? 'active' : '' }}">
                  <i class="fa fa-trophy me-2"></i>Hasil
              </a>
          </li>
      </ul>
  </div>