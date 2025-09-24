<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Dashboard')</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --navbar-height: 56px;
        /* tinggi navbar */
        --sidebar-width: 250px;
    }

    body {
        padding-top: var(--navbar-height);
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: var(--navbar-height);
        left: 0;
        width: var(--sidebar-width);
        height: calc(100vh - var(--navbar-height));
        background-color: #f8f9fa;
        padding-top: 1rem;
        transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
        z-index: 1000;
    }

    .sidebar.collapsed {
        transform: translateX(-100%);
    }

    /* Content */
    .content {
        flex: 1;
        padding: 20px;
        transition: margin-left 0.3s ease-in-out;
    }

    /* Desktop layout */
    @media (min-width: 768px) {
        .content {
            margin-left: var(--sidebar-width);
        }

        .content.expanded {
            margin-left: 0;
        }
    }

    /* Mobile layout */
    @media (max-width: 767.98px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .content {
            margin-left: 0;
        }
    }

    /* Overlay (mobile) */
    .overlay {
        display: none;
        position: fixed;
        top: var(--navbar-height);
        left: 0;
        width: 100%;
        height: calc(100vh - var(--navbar-height));
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .overlay.show {
        display: block;
    }

    .sidebar{
        background: #000000ff;
        background-color: #f9f9f9ff
    }
    /* Sidebar links */
    .sidebar .nav-link {
        color: #333;
        padding: 10px 20px;
        border-radius: .375rem;
    }

    .sidebar .nav-link:hover {
        background-color: #e9ecef;
    }

    .sidebar .nav-link.active {
        background-color: #0d6efd;
        color: #fff;
    }

    /* Footer */
    footer {
        background: #ffffffff;
        padding: 10px 20px;
        text-align: center;
        border-top: 1px solid #ddd;
    }
    .sidebar .nav-link.active {
        background-color: #181617ff !important;
        /* hitam */
        color: #fff !important;
        /* teks putih agar kontras */
        border-radius: 5px;
    }

    .sidebar .nav-link {
        color: #333;
    }

    .sidebar .nav-link:hover {
        background-color: #e9ecef;
        color: #000;
        border-radius: 5px;
    }
    .navbar-red-900 {
        background-color: #000000ff !important; /* Tailwind red-900 */
    }

    .navbar-red-900 .nav-link,
    .navbar-red-900 .navbar-brand {
        color: #fff !important;
    }

    .navbar-red-900 .nav-link.active {
        color: #ffcccc !important; /* sedikit berbeda untuk link aktif */
    }
    .featured-image img {
    width: 15%;               /* mengikuti lebar container */
    aspect-ratio: 5 / 6;       /* lebar : tinggi = 8:7 */
    object-fit: cover;         /* tetap proporsional, crop jika perlu */
    border-radius: 10px;       /* opsional, lebih rapi */
    box-shadow: 0 5px 20px rgba(0,0,0,0.15); /* efek modern */
}
</style>

