<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.partials.admin-head')
</head>
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        
        {{-- Sidebar --}}
        @include('admin.partials.admin-sidebar')

        {{-- Content --}}
        <div class="content">
            @include('admin.partials.admin-header')

            <main class="p-4">
                @yield('content')
            </main>

            @include('admin.partials.admin-footer')
        </div>
    </div>
</body>
</html>
