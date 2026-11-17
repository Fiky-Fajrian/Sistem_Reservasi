
document.addEventListener("DOMContentLoaded", function () {
    // Elemen sidebar dan tombol
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");

    const menuToggle =
        document.getElementById("menuToggle") ||
        document.getElementById("menuButton");

    const closeSidebar =
        document.getElementById("closeSidebar") ||
        document.getElementById("closeButton");

    // Fungsi buka sidebar
    function openMenu() {
        if (sidebar) sidebar.classList.add("open");
        if (overlay) overlay.classList.add("active");
    }

    // Fungsi tutup sidebar
    function closeMenu() {
        if (sidebar) sidebar.classList.remove("open");
        if (overlay) overlay.classList.remove("active");
    }

    // Event tombol menu
    if (menuToggle) {
        menuToggle.addEventListener("click", openMenu);
    }

    if (closeSidebar) {
        closeSidebar.addEventListener("click", closeMenu);
    }

    if (overlay) {
        overlay.addEventListener("click", closeMenu);
    }

    // Navigasi sidebar
    document.querySelectorAll(".nav-link").forEach(function (link) {
        link.addEventListener("click", function (event) {
            const href = link.getAttribute("href");

            if (href === "#") {
                event.preventDefault();
            } else {
                document.querySelectorAll(".nav-link").forEach(function (item) {
                    item.classList.remove("active");
                });

                link.classList.add("active");
            }

            if (window.innerWidth <= 850) {
                closeMenu();
            }
        });
    });

    // Tanggal dashboard
    const currentDate = document.getElementById("currentDate");
    const today = new Date();

    if (currentDate) {
        currentDate.textContent = new Intl.DateTimeFormat("id-ID", {
            day: "numeric",
            month: "short",
            year: "numeric"
        }).format(today);
    }

    // Tombol tanggal
    const dateButton = document.getElementById("dateButton");

    if (dateButton) {
        dateButton.addEventListener("click", function () {
            alert("Tanggal dashboard: " + today.toLocaleDateString("id-ID"));
        });
    }

    // Tombol periode laporan
    const periodButton = document.getElementById("periodButton");

    if (periodButton) {
        periodButton.addEventListener("click", function () {
            alert("Pilihan periode laporan akan kita hubungkan pada tahap berikutnya.");
        });
    }

    // Tombol notifikasi
    const notificationButton = document.getElementById("notificationButton");

    if (notificationButton) {
        notificationButton.addEventListener("click", function () {
            alert("Belum ada notifikasi baru!");
        });
    }
});
