<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.partials.user-head')
</head>
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        
        {{-- Sidebar --}}
        @include('user.partials.user-sidebar')

        {{-- Content --}}
        <div class="content">
            @include('user.partials.user-header')

            <main class="p-4">
                @yield('content')
            </main>

            @include('user.partials.user-footer')
        </div>
    </div>
</body>
</html>
