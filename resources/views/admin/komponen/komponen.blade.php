<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
</head>

<body>
    {{-- Header --}}
    @include('admin.partials.header')

    <div class="d-flex">
        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        {{-- Konten utama --}}
        <div class="content" id="content">
            @yield('content')
        </div>
    </div>

    {{-- Footer --}}
    @include('admin.partials.footer')
</body>

</html>