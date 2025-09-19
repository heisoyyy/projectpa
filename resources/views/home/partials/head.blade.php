<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  {{-- Google Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  {{-- Dynamic Title --}}
  <title>@yield('title', 'LKBB Komando')</title>

  {{-- Favicon (optional, bisa pakai Logo.jpeg) --}}
  <link rel="icon" href="{{ asset('assets/images/Logo.jpg') }}" type="image/jpeg">

  {{-- Bootstrap core CSS --}}
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  {{-- Additional CSS Files --}}
  <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/templatemo-villa-agency.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

  {{-- SwiperJS CSS --}}
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  {{-- Extra CSS per halaman --}}
  @stack('styles')
  <!-- Custom CSS -->
  <style>
    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .biodata-card img {
      max-height: 250px;
      object-fit: cover;
    }

    .dokumen-card img {
      max-height: 180px;
      object-fit: contain;
      padding: 10px;
    }
  </style>
  @push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

<style>
/* Banner Parallax */
.main-banner .item {
  height: 80vh;
  background-size: cover;
  background-position: center;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}
.header-text {
  color: #fff;
  text-align: center;
  text-shadow: 0 2px 15px rgba(0,0,0,0.5);
}

/* Featured Section */
.featured .left-image img {
  border-radius: 15px;
  transition: transform 0.3s ease;
}
.featured .left-image img:hover {
  transform: scale(1.05) rotate(2deg);
}
.featured-icon {
  transition: transform 0.3s ease;
}
.featured-icon:hover {
  transform: rotate(15deg);
}

/* Video Frame */
.video-frame {
  position: relative;
  cursor: pointer;
  overflow: hidden;
  border-radius: 15px;
  box-shadow: 0 5px 25px rgba(0,0,0,0.3);
  transition: transform 0.3s;
}
.video-frame img {
  display: block;
  width: 100%;
}
.play-btn {
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: #fff;
  transform: translate(-50%, -50%);
  transition: transform 0.3s, color 0.3s;
}
.video-frame:hover .play-btn {
  transform: translate(-50%, -50%) scale(1.3);
  color: #ff4d4d;
}
.video-frame:hover {
  transform: scale(1.05);
}

/* Statistik Counter */
.counter {
  background: #fff;
  border-radius: 15px;
  padding: 30px;
  box-shadow: 0 5px 25px rgba(0,0,0,0.1);
  transition: transform 0.3s;
}
.counter:hover {
  transform: translateY(-5px);
}

/* Juara Tabs Smooth */
.nav-tabs .nav-link {
  border: none;
  padding: 10px 25px;
  font-weight: bold;
  transition: all 0.3s;
}
.nav-tabs .nav-link.active {
  background: #ff4d4d;
  color: #fff;
  border-radius: 10px;
}
.tab-content .tab-pane {
  animation: fadeIn 0.5s ease-in-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Form & Buttons */
.btn-primary {
  background-color: #ff4d4d;
  border-color: #ff4d4d;
  transition: background-color 0.3s, transform 0.3s;
}
.btn-primary:hover {
  background-color: #e64444;
  transform: translateY(-3px);
}

/* Contact Cards */
.contact .item {
  background: #fff;
  border-radius: 15px;
  padding: 20px;
  transition: transform 0.3s;
  box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
.contact .item:hover {
  transform: translateY(-5px);
}
</style>
@endpush

</head>