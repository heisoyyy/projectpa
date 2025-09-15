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
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

  {{-- Extra CSS per halaman --}}
  @stack('styles')
</head>
