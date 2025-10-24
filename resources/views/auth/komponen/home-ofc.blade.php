<!DOCTYPE html>
<html lang="en">
@include('home.partials.head')

<body>

  <!-- Programmer By Heisoyyy -->
  <!-- Preloader -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

  {{-- Header --}}
  @include('home.partials.header')

  {{-- Main Content --}}
  <main>
    @yield('content')
  </main>

  {{-- Footer --}}
  @include('home.partials.footer')

</body>

</html>