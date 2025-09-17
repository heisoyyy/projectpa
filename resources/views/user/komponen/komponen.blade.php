<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.partials.head')
</head>

<body>
    {{-- Header --}}
    @include('user.partials.header')

    <div class="d-flex">
        {{-- Sidebar --}}
        @include('user.partials.sidebar')

        {{-- Konten utama --}}
        <div class="content" id="content">
            @yield('content')
        </div>
    </div>

    {{-- Footer --}}
    @include('user.partials.footer')
</body>

</html>