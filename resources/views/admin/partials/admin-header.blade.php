<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="#" class="sidebar-toggler btn-light flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <a href="{{ url('') }}" class="navbar-brand d-lg-none me-4">
        <h2 class="mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>

    <div class="d-none d-md-flex ms-4 align-items-center">
        <h5 class="mb-0 fw-bold ">OSIS SMAN PLUS</h5>
    </div>
    <div class="navbar-nav align-items-center ms-auto">
        {{-- Profile --}}
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="{{ asset('assets/a2/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">Admin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="{{ url('admin/profile-admin') }}"
                    class="dropdown-item {{ Request::is('admin/profile-admin') ? 'active bg-secondary' : '' }}">
                    Profile
                </a>
                <a href="{{ url('admin/setting-admin') }}"
                    class="dropdown-item {{ Request::is('admin/setting-admin') ? 'active bg-secondary' : '' }}">
                    Settings
                </a>
            </div>

        </div>
    </div>
</nav>