<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Koshub</title>
        <link rel="stylesheet" href="{{ asset('koshub.css') }}">
    </head>
    <body>
        
    <div class="app-layout">
        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <div class="brand-icon">K</div>
                <div>
                    <h2>KosHub</h2>
                    <span>Property Management</span>
                </div>
                <button class="close-sidebar" id="closeSidebar" aria-label="Tutup menu">x</button>
            </div>

            <div class="menu-label">MENU UTAMA</div>

            <nav class="navigation">
                <a href="/dashboard" class="nav-link active">
                    <span class="nav-icon">▦</span> DASHBOARD
                </a>
                 <a href="#" class="nav-link">
                    <span class="nav-icon">⌂</span> Properti Saya
                </a>
                 <a href="#" class="nav-link">
                    <span class="nav-icon">▤</span> Manajemen Kamar
                </a>
                 <a href="#" class="nav-link">
                    <span class="nav-icon">♙</span> Data Penghuni
                </a>
                 <a href="#" class="nav-link">
                    <span class="nav-icon">▧</span> Tagihan & Pembayaran
                </a>
                 <a href="#" class="nav-link">
                    <span class="nav-icon">ϟ</span> Meteran
                </a>

                <div class="menu-label secondary-label">PENGELOLAAN</div>

                <a href="#" class="nav-link">
                    <span class="nav-icon">♧</span> Manajemen Staf
                </a>
                <a href="#" class="nav-link">
                    <span class="nav-icon">⚙</span> Pengaturan
                </a>
            </nav>

            <div class="user-bottom">
                <div class="help-card">
                    <strong>Butuh bantuan?</strong>
                    <p>Kelola kos jadi lebih mudah bernama KosHub</p>
                    <a href="#">Pusat Bantuan →</a>
                </div>

                <div class="user-profile">
                    <div class="avatar">FP</div>
                    <div class="user-info">
                        <strong>Pemilik Kos</strong>
                        <span>Administrator</span>
                    </div>
                    <span class="profile-menu">⋯</span>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle" aria-label="Buka menu">☰</button>
                    <div class="breadcrumb">Halaman <span>/</span> <strong>Dashboard</strong></div>
                </div>

                <div class="topbar-right">
                    <button class="icon-button" aria-label="Notifikasi">♧</button>
                    <div class="topbar-divider"></div>
                    <div class="mini-profile">FP</div>
                    <div class="topbar-user">
                        <strong>Pemilik Kos</strong>
                        <span>Administrator</span>
                    </div>
                </div>
            </header>

            <div class="page-content">
                <section class="welcome-section">
                    <div>
                        <div class="eyebrow">RINGKASAN PROPERTI</div>
                        <h1>Dashboard Overview</h1>
                        <p>Selamat datang kembali Berikut ringkasan pengelola kos Anda.</p>
                    </div>

                    <button class="primary-button" id="dateButton">
                        <span>▦</span> <span>Hari ini</span>
                    </button>
                </section>

                <section class="propety-banner">
                    <div class="banner-decoration decoration-one"></div>
                    <div class="banner-decoration decoration-two"></div>
                    <div class="banner-content">
                        <span class="banner-tag">DASHBOARD PEMILIK</span>
                        <h2>Kelola properti Anda<br>lebih praktis bersama KosHub.</h2>
                        <p>Pantau kamar, penghuni, dan operasional kos dalam satu tempat.</p>
                    </div>
                    <div class="banner-illustration" aria-hidden="true"">
                        <div class="building">
                            <div class="building-roof"></div>
                            <div class="building-body">
                                <div class="buiding-window"></div>
                                <div class="buiding-window"></div>
                                <div class="buiding-window"></div>
                                <div class="buiding-window"></div>
                                <div class="bulding-door"></div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section-heading">
                    <div>
                        <h2>Statistik Properti</h2>
                        <p>Ringkasan kondisi properti Anda saat ini.</p>
                    </div>
                </section>

                <section class="stats-grid">
                    <article class="stats-card">
                        <div class="stats-top">
                            <span class="stat-label">Total kamar</span>
                            <div class="stat-icon blue">▦</div>
                        </div>
                        <div class="stat-value">48</div>
                        <div class="stat-footer"><span class="stat-neutral">Semua unit</span><span>Terdaftar</span></div>
                    </article>

                    <article class="stat-card">
                        <div class="stat-top">
                            <span class="stat-label">Kamar Terisi</span>
                            <div class="stat-icon green">✓</div>
                        </div>
                        <div class="stat-value">36</div>
                        <div class="stat-footer"><span class="stat-positive">75%</span><span>tingkat hunian</span></div>
                    </article>

                    <article class="stat-card">
                        <div class="stat-top">
                            <span class="stat-label">Kamar Kosong</span>
                            <div class="stat-icon orange">⌂</div>
                        </div>
                        <div class="stat-value">12</div>
                        <div class="stat-footer"><span class="stat-neutral">Tersedia</span><span>untuk disewa</span></div>
                    </article>

                    <article class="stat-card">
                        <div class="stat-top">
                            <span class="stat-label">Total Penghuni</span>
                            <div class="stat-icon purple">♙</div>
                        </div>
                        <div class="stat-value">34</div>
                        <div class="stat-footer"><span class="stat-neutral">Penghuni aktif</span></div>
                    </article>
                </section>

                <section class="content-grid">
                    <article class="panel revenue-panel">
                        <div class="panel-heading">
                            <div>
                                <h2>Ringkasan Pemasukan</h2>
                                <p>Gambaran pendapatan properti.</p>
                            </div>
                            <button class="select-button" id="periodButton">Bulan ini⌄</button>
                        </div>

                        <div class="revenue-total">
                            <span>Total pemasukan</span>
                            <h3>Rp. 18.500.000</h3>
                            <span class="revenue-note">Data contoh - belum terhubung ke database</span>
                        </div>

                        <div class="chart" aria-label="Grafik ilustrasi pemasukan">
                            <div class="chart-grid">
                                <div class="chart-row"><span>20 jt</span><div></div></div>
                                <div class="chart-row"><span>15 jt</span><div></div></div>
                                <div class="chart-row"><span>10 jt</span><div></div></div>
                                <div class="chart-row"><span>5 jt</span><div></div></div>
                            </div>
                            <div class="chart-bars">
                                <div class="bar-item"><div class="bar" style="height: 42%"></div><span>Mei</span></div>
                                <div class="bar-item"><div class="bar" style="height: 60%"></div><span>Jun</span></div>
                                <div class="bar-item"><div class="bar" style="height: 48%"></div><span>Jul</span></div>
                                <div class="bar-item"><div class="bar" style="height: 78%"></div><span>Agu</span></div>
                                <div class="bar-item"><div class="bar" style="height: 65%"></div><span>Sep</span></div>
                                <div class="bar-item"><div class="bar current" style="height: 92%"></div><span>Okt</span></div>
                            </div>
                        </div>
                    </article>

                    <article class="panel occupancy-panel">
                        <div class="panel-heading">
                            <div>
                                <h2>Status Hunian</h2>
                                <p>Perbandingan kondisi kamar.</p>
                            </div>
                        </div>

                        <div class="occupancy-visual">
                            <div class="donut">
                                <div class="donut-center">
                                    <strong>75%</strong>
                                    <span>Terisi</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div><span class="legend-dot occupied"></span><span>Kamar terisi</span><strong>36</strong></div>
                            <div><span class="legend-dot vacant"></span><span>Kamar kosong</span><strong>12</strong></div>
                        </div>
                    </article>
                </section>

                <section class="panel room-panels">
                    <div class="panel-heading">
                        <div>
                            <h2>Informasi Kamar</h2>
                            <p>Pantau status kamar di properti Anda.</p>
                        </div>
                        <a href="#" class="text-link">Lihat semua</a>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Kamar</th>
                                    <th>Penghuni</th>
                                    <th>Harga / Bulan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><div class="room-name"><span class="room-symbol">⌂</span><div><strong>Kamar A-01</strong><span>Lantai 1</span></div></div></td>
                                    <td>Andi Pratama</td>
                                    <td>Rp 1.500.000</td>
                                    <td><span class="status-badge occupied-badge">Terisi</span></td>
                                    <td><button class="action-button" aria-label="Detail Kamar A-01">⋯</button></td>
                                </tr>
                                <tr>
                                    <td><div class="room-name"><span class="room-symbol">⌂</span><div><strong>Kamar A-02</strong><span>Lantai 1</span></div></div></td>
                                    <td>Siti Rahma</td>
                                    <td>Rp 1.250.000</td>
                                    <td><span class="status-badge occupied-badge">Terisi</span></td>
                                    <td><button class="action-button" aria-label="Detail Kamar A-02">⋯</button></td>
                                </tr>
                                <tr>
                                     <td><div class="room-name"><span class="room-symbol">⌂</span><div><strong>Kamar B-01</strong><span>Lantai 2</span></div></div></td>
                                    <td>—</td>
                                    <td>Rp 1.000.000</td>
                                    <td><span class="status-badge vacant-badge">Kosong</span></td>
                                    <td><button class="action-button" aria-label="Detail Kamar B-01">⋯</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <footer class="footer">
                    <span>© 2026 KosHub. Property Management System.</span>
                    <span>Dibuat untuk pengelolaan kos yang lebih mudah.</span>
                </footer>
            </div>
        </main>
    </div>
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        <script src="{{ asset('koshub.js') }}"></script>
    </body>
</html>