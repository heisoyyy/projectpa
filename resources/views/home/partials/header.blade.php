<header class="header-area header-sticky">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="main-nav">
          <!-- Logo -->
          <a href="{{ url('/home') }}" class="logo">
            <h1>Komando</h1>
          </a>
          <!-- Menu -->
          <ul class="nav">
            <li>
              <a href="{{ url('/home') }}" 
                 class="{{ request()->is('home') ? 'active' : '' }}">
                 Home
              </a>
            </li>
            <li>
              <a href="{{ url('/home/informasi') }}" 
                 class="{{ request()->is('home/informasi') ? 'active' : '' }}">
                 Informasi
              </a>
            </li>
            <li>
              <a href="{{ url('/home/pendaftaran') }}" 
                 class="{{ request()->is('home/pendaftaran') ? 'active' : '' }}">
                 Pendaftaran
              </a>
            </li>
            <li>
              <a href="{{ url('/home/contact') }}" 
                 class="{{ request()->is('home/contact') ? 'active' : '' }}">
                 Kontak
              </a>
            </li>
            <li>
              <a href="{{ url('/home/login') }}" 
                 class="{{ request()->is('home/login') ? 'active' : '' }}">
                 <i class="fa fa-address-card"></i> Login
              </a>
            </li>
          </ul>
          <a class="menu-trigger">
            <span>Menu</span>
          </a>
        </nav>
      </div>
    </div>
  </div>
</header>
