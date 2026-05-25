{{-- ✅ HEADER --}}
<header class="header-area header-sticky">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12">
        <nav class="main-nav d-flex justify-content-between align-items-center">

          {{-- 🔸 Logo --}}
          <a href="{{ url('/home') }}" class="logo-link">
            <h1 class="logo-text">Komando</h1>
          </a>

          {{-- 🔸 Menu Desktop --}}
          <ul class="nav">
            <li>
              <a href="{{ url('/home') }}" class="{{ request()->is('home') ? 'active' : '' }}">
                <i class="fa fa-home me-1"></i> Home
              </a>
            </li>
            <li>
              <a href="{{ url('informasi') }}" class="{{ request()->is('informasi') ? 'active' : '' }}">
                <i class="fa fa-info-circle me-1"></i> Informasi
              </a>
            </li>
            <li>
              <a href="{{ url('/home/pendaftaran') }}" class="{{ request()->is('home/pendaftaran') ? 'active' : '' }}">
                <i class="fa fa-edit me-1"></i> Pendaftaran
              </a>
            </li>
            <li>
              <a href="{{ url('/home/contact') }}" class="{{ request()->is('home/contact') ? 'active' : '' }}">
                <i class="fa fa-envelope me-1"></i> Kontak
              </a>
            </li>
            <li class="nav-login">
              <a href="{{ url('/home/login') }}" class="btn-login {{ request()->is('home/login') ? 'active' : '' }}">
                <i class="fa fa-address-card me-1"></i> Login
              </a>
            </li>
          </ul>

          {{-- 🔸 Hamburger Button --}}
          <div class="menu-trigger" aria-label="Toggle Menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </div>

        </nav>
      </div>
    </div>
  </div>
</header>

{{-- ✅ CSS Tambahan --}}
<style>
  /* Login button beda dari menu biasa */
  .nav .nav-login a.btn-login {
    background: linear-gradient(135deg, #e63946, #c1121f);
    color: #fff !important;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3);
  }

  .nav .nav-login a.btn-login:hover,
  .nav .nav-login a.btn-login.active {
    background: linear-gradient(135deg, #c1121f, #9d0208);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(230, 57, 70, 0.45);
    color: #fff !important;
  }

  /* Icon di menu jadi sedikit lebih kecil */
  .nav li a i {
    font-size: 13px;
    opacity: 0.85;
  }

  /* Smooth transition untuk semua link */
  .nav li a {
    transition: color 0.25s ease, border-bottom 0.25s ease;
  }

  /* Hamburger animation */
  .menu-trigger .bar {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: block;
  }

  .menu-trigger.active .bar:nth-child(1) {
    transform: translateY(8px) rotate(45deg);
  }

  .menu-trigger.active .bar:nth-child(2) {
    opacity: 0;
    transform: scaleX(0);
  }

  .menu-trigger.active .bar:nth-child(3) {
    transform: translateY(-8px) rotate(-45deg);
  }

  /* Mobile nav slide-down */
  @media (max-width: 767px) {
    .header-area .nav {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, opacity 0.3s ease;
      opacity: 0;
    }

    .header-area .nav.show {
      max-height: 500px;
      opacity: 1;
    }

    .nav .nav-login a.btn-login {
      display: inline-block;
      margin: 8px 15px;
    }
  }
</style>

{{-- ✅ Script --}}
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const trigger = document.querySelector(".menu-trigger");
    const nav = document.querySelector(".header-area .nav");

    trigger.addEventListener("click", () => {
      trigger.classList.toggle("active");
      nav.classList.toggle("show");
    });

    // Tutup menu mobile saat klik link
    nav.querySelectorAll("a").forEach(link => {
      link.addEventListener("click", () => {
        trigger.classList.remove("active");
        nav.classList.remove("show");
      });
    });

    // Tutup menu saat klik di luar
    document.addEventListener("click", (e) => {
      if (!trigger.contains(e.target) && !nav.contains(e.target)) {
        trigger.classList.remove("active");
        nav.classList.remove("show");
      }
    });
  });
</script>