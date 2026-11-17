/* =============================================
   KosHub Dashboard — JavaScript
   ============================================= */

document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('menuToggle');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    // Open sidebar
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.add('open');
            sidebarOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    // Close sidebar functions
    function closeSidebarFn() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (closeSidebar) {
        closeSidebar.addEventListener('click', closeSidebarFn);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebarFn);
    }

    // Close sidebar on ESC key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) {
            closeSidebarFn();
        }
    });

    // Handle window resize: if resizing back to desktop, clean up mobile sidebar state
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024) {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    console.log('KosHub Dashboard loaded successfully.');
});
