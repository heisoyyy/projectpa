<!-- Footer -->
<footer class="text-black text-center py-3 mt-auto">
    &copy; {{ date('Y') }} SMAN PLUS PROVINSI RIAU. All rights reserved.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar Toggle -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('overlay');

        if (sidebar && content && sidebarToggle && overlay) {
            sidebarToggle.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                } else {
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('expanded');
                }
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            });
        }
    });
</script>
