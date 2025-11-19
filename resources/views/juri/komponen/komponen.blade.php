<!DOCTYPE html>
<html lang="en">

<head>
    @include('juri.partials.head')
</head>

<body>
    {{-- Header --}}
    @include('juri.partials.header')

    <div class="d-flex">
        {{-- Sidebar --}}
        @include('juri.partials.sidebar')

        {{-- Konten utama --}}
        <div class="content" id="content">
            @yield('content')
        </div>
    </div>

    {{-- Footer --}}
    @include('juri.partials.footer')
</body>

</html>