<header class="header-area header-sticky">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12">
        <nav class="main-nav d-flex justify-content-between align-items-center">

          <!-- 🔸 Logo -->
          <a href="{{ url('/home') }}" >
            <h1 class="logo-text">Komando</h1>
          </a>

          <!-- 🔸 Menu -->
          <ul class="nav">
            <li><a href="{{ url('/home') }}" class="{{ request()->is('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ url('informasi') }}" class="{{ request()->is('informasi') ? 'active' : '' }}">Informasi</a></li>
            <li><a href="{{ url('/home/pendaftaran') }}" class="{{ request()->is('home/pendaftaran') ? 'active' : '' }}">Pendaftaran</a></li>
            <li><a href="{{ url('/home/contact') }}" class="{{ request()->is('home/contact') ? 'active' : '' }}">Kontak</a></li>
            <li><a href="{{ url('/home/login') }}" class="{{ request()->is('home/login') ? 'active' : '' }}"><i class="fa fa-address-card"></i> Login</a></li>
          </ul>

          <!-- 🔸 Modern Mobile Menu Button -->
          <div class="menu-trigger" aria-label="Menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </div>

        </nav>
      </div>
    </div>
  </div>
</header>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const trigger = document.querySelector(".menu-trigger");
    const nav = document.querySelector(".header-area .nav");

    trigger.addEventListener("click", () => {
      trigger.classList.toggle("active");
      nav.classList.toggle("show");
    });
  });
</script>