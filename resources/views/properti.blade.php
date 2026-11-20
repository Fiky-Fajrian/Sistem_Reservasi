<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properti Saya — KosHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('koshub.css') }}">
    <link rel="stylesheet" href="{{ asset('properti.css') }}">
</head>
<body>
    <div class="app-layout">
        {{-- ================= SIDEBAR (Persis seperti Sidebar Dashboard) ================= --}}
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
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <span class="nav-icon">▦</span> DASHBOARD
                </a>
                <a href="{{ route('properti.index') }}" class="nav-link {{ !request()->routeIs('kamar.index') ? 'active' : '' }}">
                    <span class="nav-icon">⌂</span> Properti Saya
                </a>
                <a href="{{ route('kamar.index') }}" class="nav-link {{ request()->routeIs('kamar.index') ? 'active' : '' }}">
                    <span class="nav-icon">▤</span> Manajemen Kamar
                </a>
                <a href="{{ route('penghuni.index') }}" class="nav-link">
                    <span class="nav-icon">♙</span> Data Penghuni
                </a>
                <a href="{{ route('tagihan.index') }}" class="nav-link">
                    <span class="nav-icon">▧</span> Tagihan & Pembayaran
                </a>
                <a href="{{ route('meteran.index') }}" class="nav-link">
                    <span class="nav-icon">ϟ</span> Meteran
                </a>

                <div class="menu-label secondary-label">PENGELOLAAN</div>

                <a href="#" class="nav-link">
                    <span class="nav-icon">♧</span> Manajemen Staf
                </a>
                <a href="#" class="nav-link">
                    <span class="nav-icon">⚙</span> Pengaturan
                </a>
                <a href="javascript:void(0)" onclick="openTicketsModal()" class="nav-link">
                    <span class="nav-icon">💬</span> Chat & Keluhan
                    @if($activeTickets->count() > 0)
                        <span style="background: #ef4444; color: #fff; font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 10px; margin-left: auto;">{{ $activeTickets->count() }}</span>
                    @endif
                </a>
            </nav>

            <div class="user-bottom">
                <div class="help-card">
                    <strong>Butuh bantuan?</strong>
                    <p>Kelola kos jadi lebih mudah bernama KosHub</p>
                    <a href="#">Pusat Bantuan →</a>
                </div>

                <div class="user-profile">
                    <div class="avatar">{{ auth()->check() ? strtoupper(mb_substr(auth()->user()->name, 0, 2)) : 'FP' }}</div>
                    <div class="user-info">
                        <strong>{{ auth()->user()->name ?? 'Pemilik Kos' }}</strong>
                        <span>Administrator</span>
                    </div>
                    <span class="profile-menu">⋯</span>
                </div>
            </div>
        </aside>

        {{-- ================= MAIN CONTENT ================= --}}
        <main class="main-content">
            {{-- TOPBAR (Persis seperti Topbar Dashboard) --}}
            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle" aria-label="Buka menu">☰</button>
                    <div class="breadcrumb">Halaman <span>/</span> <strong>{{ request()->routeIs('kamar.index') ? 'Manajemen Kamar' : 'Properti Saya' }}</strong></div>
                </div>

                <div class="topbar-right">
                    <button class="icon-button" onclick="openTicketsModal()" aria-label="Notifikasi & Keluhan" title="Tiket Kerusakan & Keluhan" style="position: relative;">
                        ♧
                        @if($activeTickets->count() > 0)
                            <span style="position: absolute; top: 6px; right: 6px; width: 8px; height: 8px; background: #ef4444; border-radius: 50%;"></span>
                        @endif
                    </button>
                    <div class="topbar-divider"></div>
                    <div class="mini-profile">{{ auth()->check() ? strtoupper(mb_substr(auth()->user()->name, 0, 2)) : 'FP' }}</div>
                    <div class="topbar-user">
                        <strong>{{ auth()->user()->name ?? 'Pemilik Kos' }}</strong>
                        <span>Administrator</span>
                    </div>
                </div>
            </header>

            {{-- PAGE CONTENT --}}
            <div class="page-content">
                {{-- HERO SECTION: Welcome Section (Persis struktur Dashboard) --}}
                <section class="welcome-section">
                    <div>
                        <div class="eyebrow">MANAJEMEN PROPERTI</div>
                        <h1>Manajemen Kamar & Ketersediaan Unit</h1>
                        <p>Kelola status okupansi 25 unit kamar, hierarki lantai, penetapan harga dinamis, dan fasilitas per kamar secara real-time.</p>
                    </div>

                    <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                        <button type="button" class="btn-prop-outline" onclick="openTicketsModal()">
                            <span>🔧</span> Tiket Kerusakan ({{ $activeTickets->count() }})
                        </button>
                        <button type="button" class="primary-button" onclick="alert('Form Tambah Unit Kamar Baru siap digunakan.')">
                            <span>+</span> <span>Tambah Unit Kamar Baru</span>
                        </button>
                    </div>
                </section>

                {{-- HERO SECTION: Property Banner (Persis desain banner Dashboard) --}}
                <section class="propety-banner">
                    <div class="banner-decoration decoration-one"></div>
                    <div class="banner-decoration decoration-two"></div>
                    <div class="banner-content">
                        <span class="banner-tag">DAFTAR & KETERSEDIAAN KAMAR • 25 UNIT TOTAL</span>
                        <h2>Griya Samudra Banyuwangi<br>Pantau status unit kamar lebih praktis.</h2>
                        <p>Hierarki 2 lantai, tingkat hunian 92%, dan kesiapan kamar siap huni dalam satu tempat terintegrasi.</p>
                    </div>
                    <div class="banner-illustration" aria-hidden="true">
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

                {{-- Flash Message --}}
                @if(session('success'))
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13px; display: flex; align-items: center; justify-content: space-between;">
                        <span>✓ {{ session('success') }}</span>
                        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; cursor:pointer; font-weight:bold; color:#166534;">×</button>
                    </div>
                @endif

                {{-- SECTION HEADING --}}
                <section class="section-heading">
                    <div>
                        <h2>Statistik Ketersediaan Unit</h2>
                        <p>Ringkasan kapasitas dan kondisi unit kamar Griya Samudra saat ini.</p>
                    </div>
                </section>

                {{-- 4 STAT CARDS (Menggunakan style cards Dashboard dengan data Mockup) --}}
                <section class="stats-grid">
                    <article class="stat-card">
                        <div class="stat-top">
                            <span class="stat-label">Total Kapasitas</span>
                            <div class="stat-icon blue">▦</div>
                        </div>
                        <div class="stat-value">25 <small style="font-size: 14px; font-weight: 500; color: #64748b;">Kamar</small></div>
                        <div class="stat-footer"><span class="stat-neutral">Lt. 1: 12 unit</span><span>•</span><span>Lt. 2: 13 unit</span></div>
                    </article>

                    <article class="stat-card">
                        <div class="stat-top">
                            <span class="stat-label">Terisi (Occupied)</span>
                            <div class="stat-icon green">✓</div>
                        </div>
                        <div class="stat-value">22</div>
                        <div class="stat-footer"><span class="stat-positive">92%</span><span>tingkat hunian</span></div>
                    </article>

                    <article class="stat-card">
                        <div class="stat-top">
                            <span class="stat-label">Siap Huni (Available)</span>
                            <div class="stat-icon orange">⌂</div>
                        </div>
                        <div class="stat-value">2 <small style="font-size: 14px; font-weight: 500; color: #64748b;">Unit</small></div>
                        <div class="stat-footer"><span class="stat-neutral">Km. 103 (Std)</span><span>•</span><span>Km. 202 (Dlx)</span></div>
                    </article>

                    <article class="stat-card">
                        <div class="stat-top">
                            <span class="stat-label">Pemeliharaan</span>
                            <div class="stat-icon purple">🔧</div>
                        </div>
                        <div class="stat-value">{{ $activeTickets->count() > 0 ? $activeTickets->count() : 1 }}</div>
                        <div class="stat-footer"><span style="color: #dc2626; font-weight: 600;">Km. 104: AC Bocor</span></div>
                    </article>
                </section>

                {{-- FILTER & SEARCH TOOLBAR (Sesuai Mockup) --}}
                <div class="prop-filter-toolbar">
                    <div class="prop-search-box">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.2-3.2"/></svg>
                        <input type="text" id="roomSearchInput" placeholder="Cari nomor kamar, penghuni, fasilitas..." onkeyup="filterRooms()">
                    </div>

                    <div class="prop-filter-tabs">
                        <button type="button" class="prop-filter-tab active" data-floor="all" onclick="filterFloor('all', this)">Semua Lantai (25)</button>
                        <button type="button" class="prop-filter-tab" data-floor="1" onclick="filterFloor('1', this)">Lantai 1 (12)</button>
                        <button type="button" class="prop-filter-tab" data-floor="2" onclick="filterFloor('2', this)">Lantai 2 (13)</button>
                    </div>

                    <select id="typeSelect" style="padding: 6px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 12.5px; color: #334155; background: #fff;" onchange="filterRooms()">
                        <option value="all">Semua Tipe Kamar</option>
                        <option value="deluxe">Deluxe AC</option>
                        <option value="standard">Standard Non-AC</option>
                        <option value="suite">Suite VIP</option>
                    </select>

                    <div class="prop-status-filters">
                        <button type="button" class="prop-status-pill active" data-status="all" onclick="filterStatus('all', this)">Semua</button>
                        <button type="button" class="prop-status-pill" data-status="terisi" onclick="filterStatus('terisi', this)">Terisi (22)</button>
                        <button type="button" class="prop-status-pill" data-status="tersedia" onclick="filterStatus('tersedia', this)">Siap Huni (2)</button>
                        <button type="button" class="prop-status-pill" data-status="perbaikan" onclick="filterStatus('perbaikan', this)">Perbaikan (1)</button>
                    </div>

                    <div class="prop-view-toggles">
                        <button type="button" class="prop-icon-btn active" title="Grid View">▦</button>
                        <button type="button" class="prop-icon-btn" title="List View">☰</button>
                    </div>
                </div>

                {{-- TWO-COLUMN MAIN LAYOUT (FLOORS + DETAIL DRAWER SESUAI MOCKUP) --}}
                <div class="prop-main-layout">
                    {{-- Left Area: Lantai 1 & Lantai 2 --}}
                    <div class="prop-floors-col">
                        {{-- LANTAI 1 --}}
                        <div class="floor-card" id="floor-1-card">
                            <div class="floor-header">
                                <div class="floor-header-left">
                                    <div class="floor-num-badge">1</div>
                                    <div>
                                        <h2 class="floor-title">Lantai 1 — Sayap Samudra</h2>
                                        <p class="floor-meta">12 Unit Total • 10 Terisi • 1 Siap Huni • 1 Dalam Perbaikan</p>
                                    </div>
                                </div>
                                <div class="floor-progress-wrap">
                                    <span class="floor-rate-label">TINGKAT HUNI: 83%</span>
                                    <div class="floor-progress-bar">
                                        <div class="floor-progress-fill" style="width: 83%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="rooms-grid">
                                {{-- Kamar 101 --}}
                                <div class="room-card" data-status="terisi" data-floor="1" data-type="deluxe" onclick="selectRoom('101', 'Deluxe AC', 'Rp 1.250.000', 'Terisi', 'Zidane Mansoer', this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num">101</span>
                                            <span class="room-type">Deluxe AC • 3x4m</span>
                                        </div>
                                        <span class="room-status-badge badge-occupied">● Terisi</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="tenant-info">
                                            <div class="tenant-avatar avatar-blue">ZM</div>
                                            <div class="tenant-text">
                                                <strong>Zidane Mansoer</strong>
                                                <span>Jatuh Tempo: 15 Apr 2026</span>
                                            </div>
                                        </div>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">❄ AC</span>
                                            <span class="amenity-tag">🚿 KM Dlm</span>
                                            <span class="amenity-tag">🔒 SmartLock</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Sewa</span>
                                            <strong>Rp 1.250.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action">Lihat Kontrak</button>
                                    </div>
                                </div>

                                {{-- Kamar 102 --}}
                                <div class="room-card" data-status="terisi" data-floor="1" data-type="deluxe" onclick="selectRoom('102', 'Deluxe AC', 'Rp 1.250.000', 'Terisi', 'Fiky Fajrian', this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num">102</span>
                                            <span class="room-type">Deluxe AC • 3x4m</span>
                                        </div>
                                        <span class="room-status-badge badge-occupied">● Terisi</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="tenant-info">
                                            <div class="tenant-avatar avatar-blue">FF</div>
                                            <div class="tenant-text">
                                                <strong>Fiky Fajrian</strong>
                                                <span style="color: #b45309; font-weight: 600;">⚠️ Jatuh Tempo H-3 (10 Mar)</span>
                                            </div>
                                        </div>
                                        <div class="card-alert-box">
                                            <span>Invoice #INV-098 <strong>Belum Bayar</strong></span>
                                            <button type="button" class="btn-wa-tiny" onclick="event.stopPropagation(); alert('Mengirim pengingat WhatsApp ke Fiky Fajrian...');">Kirim WA</button>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Sewa</span>
                                            <strong>Rp 1.250.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action">Lihat Detail</button>
                                    </div>
                                </div>

                                {{-- Kamar 103 (SELECTED / ACTIVE UNIT SESUAI MOCKUP) --}}
                                <div class="room-card is-selected" data-status="tersedia" data-floor="1" data-type="standard" onclick="selectRoom('103', 'Standard Non-AC', 'Rp 850.000', 'Siap Huni', null, this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num" style="color: #2563eb;">103</span>
                                            <span class="room-type">Standard Non-AC • 3x3m</span>
                                        </div>
                                        <span class="room-status-badge badge-available">● Siap Huni</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="card-ready-box">
                                            <strong>✨ Ready to Move In</strong>
                                            <span>Kunci: Pos Security</span>
                                        </div>
                                        <p class="room-desc-tiny">
                                            Kasur busa baru, lemari 2 pintu, meja belajar, KM luar bersih.
                                        </p>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">💨 Kipas Angin</span>
                                            <span class="amenity-tag">📶 WiFi 50Mbps</span>
                                            <span class="amenity-tag">🛋 Furnished</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Mulai dari</span>
                                            <strong>Rp 850.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action btn-card-primary" onclick="event.stopPropagation(); alert('Membuka form penempatan calon penghuni untuk Kamar 103');">Isi Kamar</button>
                                    </div>
                                </div>

                                {{-- Kamar 104 (PEMELIHARAAN SESUAI MOCKUP) --}}
                                <div class="room-card is-maintenance" data-status="perbaikan" data-floor="1" data-type="deluxe" onclick="openTicketsModal()">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num" style="color: #dc2626;">104</span>
                                            <span class="room-type">Deluxe AC • 3x4m</span>
                                        </div>
                                        <span class="room-status-badge badge-maintenance">🔧 Pemeliharaan</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="card-maintenance-box">
                                            <div class="ticket-title">Tiket #T-204: AC Bocor</div>
                                            <div class="ticket-meta">Est: Hari Ini 16:00 • Teknisi Budi (Sedang Diperbaiki)</div>
                                        </div>
                                        <p class="room-desc-tiny" style="color: #991b1b; font-style: italic;">
                                            Tidak dapat dipesan sebelum tiket closed.
                                        </p>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Standar</span>
                                            <strong>Rp 1.250.000</strong>
                                        </div>
                                        <button type="button" class="btn-card-action" style="border-color: #fca5a5; color: #dc2626;" onclick="event.stopPropagation(); openTicketsModal();">Update Tiket</button>
                                    </div>
                                </div>

                                {{-- Kamar 105 --}}
                                <div class="room-card" data-status="terisi" data-floor="1" data-type="deluxe" onclick="selectRoom('105', 'Deluxe AC', 'Rp 1.250.000', 'Terisi', 'Rahmat Hidayat', this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num">105</span>
                                            <span class="room-type">Deluxe AC • 3x4m</span>
                                        </div>
                                        <span class="room-status-badge badge-occupied">● Terisi</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="tenant-info">
                                            <div class="tenant-avatar avatar-blue">RH</div>
                                            <div class="tenant-text">
                                                <strong>Rahmat Hidayat</strong>
                                                <span>Jatuh Tempo: 28 Mar 2026</span>
                                            </div>
                                        </div>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">❄ AC</span>
                                            <span class="amenity-tag">🚿 KM Dlm</span>
                                            <span class="amenity-tag tag-lunas">✓ Lunas</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Sewa</span>
                                            <strong>Rp 1.250.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action">Lihat Detail</button>
                                    </div>
                                </div>

                                {{-- Kamar 106 --}}
                                <div class="room-card" data-status="terisi" data-floor="1" data-type="standard" onclick="selectRoom('106', 'Standard Non-AC', 'Rp 850.000', 'Terisi', 'Agus Santoso', this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num">106</span>
                                            <span class="room-type">Standard Non-AC</span>
                                        </div>
                                        <span class="room-status-badge badge-occupied">● Terisi</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="tenant-info">
                                            <div class="tenant-avatar avatar-blue">AS</div>
                                            <div class="tenant-text">
                                                <strong>Agus Santoso</strong>
                                                <span>Jatuh Tempo: 04 Mei 2026</span>
                                            </div>
                                        </div>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">💨 Fan</span>
                                            <span class="amenity-tag">🪑 Meja Kerja</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Sewa</span>
                                            <strong>Rp 850.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action">Lihat Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- LANTAI 2 --}}
                        <div class="floor-card" id="floor-2-card">
                            <div class="floor-header">
                                <div class="floor-header-left">
                                    <div class="floor-num-badge">2</div>
                                    <div>
                                        <h2 class="floor-title">Lantai 2 — Sayap Angkasa</h2>
                                        <p class="floor-meta">13 Unit Total • 12 Terisi • 1 Siap Huni • 0 Maintenance</p>
                                    </div>
                                </div>
                                <div class="floor-progress-wrap">
                                    <span class="floor-rate-label">TINGKAT HUNI: 92.3%</span>
                                    <div class="floor-progress-bar">
                                        <div class="floor-progress-fill" style="width: 92.3%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="rooms-grid">
                                {{-- Kamar 201 --}}
                                <div class="room-card" data-status="terisi" data-floor="2" data-type="suite" onclick="selectRoom('201', 'Suite VIP Exclusive', 'Rp 1.700.000', 'Terisi', 'Rian Pratama', this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num">201</span>
                                            <span class="room-type">Suite VIP Exclusive • 4x5m</span>
                                        </div>
                                        <span class="room-status-badge badge-occupied">● Terisi</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="tenant-info">
                                            <div class="tenant-avatar avatar-blue">RP</div>
                                            <div class="tenant-text">
                                                <strong>Rian Pratama</strong>
                                                <span>Jatuh Tempo: 12 Jun 2026 (Tahunan)</span>
                                            </div>
                                        </div>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">🌿 Balkon</span>
                                            <span class="amenity-tag">♨ Water Heater</span>
                                            <span class="amenity-tag">📺 Smart TV 43"</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Sewa</span>
                                            <strong>Rp 1.700.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action">Lihat Detail</button>
                                    </div>
                                </div>

                                {{-- Kamar 202 (SIAP HUNI) --}}
                                <div class="room-card" data-status="tersedia" data-floor="2" data-type="deluxe" onclick="selectRoom('202', 'Deluxe Balcony', 'Rp 1.350.000', 'Siap Huni', null, this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num" style="color: #2563eb;">202</span>
                                            <span class="room-type">Deluxe Balcony • 3.5x4m</span>
                                        </div>
                                        <span class="room-status-badge badge-available">● Siap Huni</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="card-ready-box">
                                            <strong>✨ Unit Standby Baru Direnovasi</strong>
                                            <span>Lantai 2 Hook</span>
                                        </div>
                                        <p class="room-desc-tiny">
                                            View menghadap pegunungan Ijen, balkon privat, full furnished AC Inverter.
                                        </p>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">🌿 Balkon Privat</span>
                                            <span class="amenity-tag">❄ AC 1 PK</span>
                                            <span class="amenity-tag">🚿 KM Dlm</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Mulai dari</span>
                                            <strong>Rp 1.350.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action btn-card-primary" onclick="event.stopPropagation(); alert('Reservasi Kamar 202');">Reservasi</button>
                                    </div>
                                </div>

                                {{-- Kamar 203 --}}
                                <div class="room-card" data-status="terisi" data-floor="2" data-type="suite" onclick="selectRoom('203', 'VIP Suite', 'Rp 1.700.000', 'Terisi', 'Bayu Saputra', this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num">203</span>
                                            <span class="room-type">VIP Suite • 4x5m</span>
                                        </div>
                                        <span class="room-status-badge badge-occupied">● Terisi</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="tenant-info">
                                            <div class="tenant-avatar avatar-blue">BS</div>
                                            <div class="tenant-text">
                                                <strong>Bayu Saputra</strong>
                                                <span>Jatuh Tempo: 19 Sep 2026</span>
                                            </div>
                                        </div>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">❄ AC</span>
                                            <span class="amenity-tag">📺 Smart TV</span>
                                            <span class="amenity-tag tag-verified">✓ Verified</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Sewa</span>
                                            <strong>Rp 1.700.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action">Lihat Detail</button>
                                    </div>
                                </div>

                                {{-- Kamar 204 --}}
                                <div class="room-card" data-status="terisi" data-floor="2" data-type="suite" onclick="selectRoom('204', 'Suite AC Plus', 'Rp 1.300.000', 'Terisi', 'Aditya R.', this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num">204</span>
                                            <span class="room-type">Suite AC Plus • 3.5x4m</span>
                                        </div>
                                        <span class="room-status-badge badge-occupied">● Terisi</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="tenant-info">
                                            <div class="tenant-avatar avatar-blue">AR</div>
                                            <div class="tenant-text">
                                                <strong>Aditya R.</strong>
                                                <span>Jatuh Tempo: 01 Nov 2026</span>
                                            </div>
                                        </div>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">❄ AC</span>
                                            <span class="amenity-tag">📶 50 Mbps</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Sewa</span>
                                            <strong>Rp 1.300.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action">Lihat Detail</button>
                                    </div>
                                </div>

                                {{-- Kamar 205 --}}
                                <div class="room-card" data-status="terisi" data-floor="2" data-type="deluxe" onclick="selectRoom('205', 'Deluxe AC', 'Rp 1.250.000', 'Terisi', 'Dinda Nurul', this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num">205</span>
                                            <span class="room-type">Deluxe AC • 3x4m</span>
                                        </div>
                                        <span class="room-status-badge badge-occupied">● Terisi</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="tenant-info">
                                            <div class="tenant-avatar avatar-green">DN</div>
                                            <div class="tenant-text">
                                                <strong>Dinda Nurul</strong>
                                                <span>Jatuh Tempo: 18 Des 2026</span>
                                            </div>
                                        </div>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">❄ AC</span>
                                            <span class="amenity-tag">🚿 KM Dlm</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Sewa</span>
                                            <strong>Rp 1.250.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action">Lihat Detail</button>
                                    </div>
                                </div>

                                {{-- Kamar 206 --}}
                                <div class="room-card" data-status="terisi" data-floor="2" data-type="standard" onclick="selectRoom('206', 'Standard Non-AC', 'Rp 850.000', 'Terisi', 'M. Kurniawan', this)">
                                    <div class="room-top">
                                        <div class="room-num-type">
                                            <span class="room-num">206</span>
                                            <span class="room-type">Standard Non-AC</span>
                                        </div>
                                        <span class="room-status-badge badge-occupied">● Terisi</span>
                                    </div>
                                    <div class="room-body">
                                        <div class="tenant-info">
                                            <div class="tenant-avatar avatar-blue">MK</div>
                                            <div class="tenant-text">
                                                <strong>M. Kurniawan</strong>
                                                <span>Jatuh Tempo: 30 Jan 2027</span>
                                            </div>
                                        </div>
                                        <div class="room-amenities">
                                            <span class="amenity-tag">💨 Fan</span>
                                            <span class="amenity-tag">🛏 Springbed</span>
                                        </div>
                                    </div>
                                    <div class="room-footer">
                                        <div class="room-price-info">
                                            <span>Tarif Sewa</span>
                                            <strong>Rp 850.000</strong><small>/bln</small>
                                        </div>
                                        <button type="button" class="btn-card-action">Lihat Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column (Detail Drawer: Unit Terpilih Kamar 103 Standard Sesuai Mockup) --}}
                    <div class="prop-drawer-col">
                        <div class="unit-drawer-card">
                            <div class="drawer-top-badges">
                                <div class="drawer-badges-left">
                                    <span class="drawer-pill-selected">UNIT TERPILIH</span>
                                    <span class="drawer-pill-ready" id="drawerStatusBadge">● Siap Dihuni</span>
                                </div>
                                <div class="drawer-top-actions">
                                    <button type="button" class="drawer-icon-btn" title="Edit Data Kamar" onclick="alert('Edit data unit kamar');">✎</button>
                                    <button type="button" class="drawer-icon-btn" title="Tutup Panel" onclick="alert('Panel detail unit tetap terbuka.');">×</button>
                                </div>
                            </div>

                            <h3 class="drawer-room-title" id="drawerRoomTitle">Kamar 103 (Standard)</h3>
                            <p class="drawer-room-loc" id="drawerRoomLoc">Lantai 1 • Sayap Samudra (Dekat Dapur Utama)</p>

                            {{-- Foto Unit --}}
                            <div class="drawer-photo-wrap">
                                <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=600&q=80" alt="Foto Kamar 103" class="drawer-photo-img">
                                <span class="photo-verified-pill">
                                    📷 4 Foto Terverifikasi
                                </span>
                            </div>

                            {{-- Skema Tarif Sewa Dinamis --}}
                            <div class="drawer-section-title">SKEMA TARIF SEWA DINAMIS</div>
                            <div class="pricing-options-grid">
                                <div class="price-option-box">
                                    <div class="price-opt-label">Harian</div>
                                    <div class="price-opt-val">Rp 75.000</div>
                                </div>
                                <div class="price-option-box active">
                                    <div class="price-opt-label">Bulanan</div>
                                    <div class="price-opt-val" id="drawerPriceMonth">Rp 850.000</div>
                                </div>
                                <div class="price-option-box">
                                    <div class="price-opt-label">Tahunan <small>(-7%)</small></div>
                                    <div class="price-opt-val">Rp 9.500.000</div>
                                </div>
                            </div>

                            {{-- Tautan Booking Publik --}}
                            <div class="drawer-booking-link-box">
                                <div class="booking-head">
                                    <span>Tautan Booking Publik (White-Label)</span>
                                    <a href="/" target="_blank">Buka Pratinjau ↗</a>
                                </div>
                                <div class="copy-url-row">
                                    <span class="copy-url-text" id="bookingUrlText">griyasamudra.koshub.id/kamar/103</span>
                                    <button type="button" class="btn-copy-tiny" onclick="copyBookingLink()">Salin</button>
                                </div>
                                <button type="button" class="btn-share-wa" onclick="shareWhatsApp()">
                                    <span>💬</span> Salin Link Promosi WhatsApp
                                </button>
                            </div>

                            {{-- Checklist Kesiapan Check-in --}}
                            <div class="drawer-checklist-box">
                                <div class="drawer-section-title">CHECKLIST KESIAPAN CHECK-IN</div>
                                <div class="checklist-items">
                                    <label class="check-item">
                                        <input type="checkbox" checked>
                                        <span>Kasur springbed bersih & disinfeksi</span>
                                    </label>
                                    <label class="check-item">
                                        <input type="checkbox" checked>
                                        <span>Kunci fisik & kartu akses standby di pos</span>
                                    </label>
                                    <label class="check-item">
                                        <input type="checkbox" checked>
                                        <span>Token listrik terisi (KWH meter normal)</span>
                                    </label>
                                    <label class="check-item">
                                        <input type="checkbox">
                                        <span>Pembersihan akhir sebelum serah terima</span>
                                    </label>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <button type="button" class="btn-assign-tenant" onclick="alert('Membuka dialog penempatan calon penghuni untuk unit ini.');">
                                <span>👤</span> Pasang Calon Penghuni Langsung
                            </button>
                            <button type="button" class="btn-toggle-maintenance" onclick="alert('Mengubah status unit ke Mode Pemeliharaan.');">
                                Ubah Status ke Maintenance / Nonaktif
                            </button>

                            {{-- Tiket Kerusakan Aktif Card --}}
                            <div class="active-ticket-drawer-card">
                                <div class="ticket-info-left">
                                    <strong>1 Tiket Kerusakan Aktif</strong>
                                    <span>Kamar 104 • Servis AC Bocor</span>
                                </div>
                                <button type="button" class="btn-ticket-detail" onclick="openTicketsModal()">
                                    Detail →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FOOTER (Sama seperti Dashboard) --}}
                <footer class="footer" style="margin-top: 40px;">
                    <span>© 2026 KosHub. Property Management System.</span>
                    <span>Dibuat untuk pengelolaan kos yang lebih mudah.</span>
                </footer>
            </div>
        </main>
    </div>

    {{-- Overlay Mobile Sidebar --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ================= FLOATING ACTION BUTTON UNTUK CHAT & KELUHAN ================= --}}
    <button type="button" class="prop-chat-fab" onclick="openComplaintModal()" title="Kirim Chat / Keluhan">
        <span>💬</span>
        <span>Chat & Keluhan Penyewa</span>
        @if($activeTickets->count() > 0)
            <span style="background: #ef4444; color: #fff; font-size: 11px; padding: 2px 6px; border-radius: 10px;">{{ $activeTickets->count() }}</span>
        @endif
    </button>

    {{-- ================= MODAL 1: FORM PENGIRIMAN CHAT & KELUHAN (UNTUK PENYEWA) ================= --}}
    <div class="prop-modal" id="complaintModal" hidden>
        <div class="prop-modal-backdrop" onclick="closeComplaintModal()"></div>
        <div class="prop-modal-dialog">
            <div class="prop-modal-head">
                <h3>💬 Kirim Chat & Keluhan ke Pengelola Kos</h3>
                <button type="button" class="prop-modal-close" onclick="closeComplaintModal()">×</button>
            </div>
            <form action="{{ route('keluhan.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Pilih Kos</label>
                    <select name="kos_id" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                        @foreach($kosList as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kos }} ({{ $k->lokasi }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Nomor Kamar</label>
                        <input type="text" name="nomor_kamar" placeholder="Contoh: 104" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Kategori Masalah</label>
                        <select name="type" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;">
                            <option value="keluhan">Kerusakan Fasilitas / AC</option>
                            <option value="perbaikan">Air & Kelistrikan</option>
                            <option value="chat">Pertanyaan / Chat Umum</option>
                            <option value="saran">Kebersihan & Keamanan</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Judul Keluhan / Topik</label>
                    <input type="text" name="subject" placeholder="Contoh: AC meneteskan air deras" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                </div>

                <div style="margin-bottom: 18px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Deskripsi Lengkap Kendala</label>
                    <textarea name="body" rows="4" placeholder="Jelaskan detail kendala yang dialami agar tim pengelola/teknisi dapat segera menindaklanjuti..." style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; font-family: inherit;" required></textarea>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-prop-outline" onclick="closeComplaintModal()">Batal</button>
                    <button type="submit" class="btn-prop-primary">Kirim Keluhan Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= MODAL 2: DAFTAR TIKET KERUSAKAN & KELUHAN (UNTUK PENGELOLA) ================= --}}
    <div class="prop-modal" id="ticketsModal" hidden>
        <div class="prop-modal-backdrop" onclick="closeTicketsModal()"></div>
        <div class="prop-modal-dialog" style="max-width: 680px;">
            <div class="prop-modal-head">
                <div>
                    <h3>🔧 Tiket Kerusakan & Chat Keluhan Masuk</h3>
                    <p style="font-size: 12px; color: #64748b; margin: 2px 0 0;">Pantau dan kelola laporan keluhan dari para penghuni kos.</p>
                </div>
                <button type="button" class="prop-modal-close" onclick="closeTicketsModal()">×</button>
            </div>

            <div style="max-height: 480px; overflow-y: auto; padding-right: 4px;">
                @forelse($messages as $msg)
                    <div class="ticket-list-item">
                        <div class="ticket-list-item-head">
                            <div>
                                <span style="font-size: 11px; font-weight: 700; color: #2563eb; background: #eff6ff; padding: 2px 6px; border-radius: 4px;">Kamar {{ $msg->nomor_kamar ?? '-' }}</span>
                                <strong style="font-size: 14px; color: #0f172a; margin-left: 6px;">{{ $msg->subject }}</strong>
                            </div>
                            <span class="ticket-badge-status ticket-status-{{ $msg->status }}">
                                {{ ucfirst(str_replace('_', ' ', $msg->status)) }}
                            </span>
                        </div>
                        <p style="font-size: 12.5px; color: #334155; margin: 6px 0 8px; line-height: 1.4;">
                            {{ $msg->body }}
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 11px; color: #64748b; border-top: 1px dashed #e2e8f0; padding-top: 8px;">
                            <span>Pengirim: <strong>{{ $msg->sender->name ?? 'Penyewa' }}</strong> • {{ $msg->created_at->diffForHumans() }}</span>
                            
                            {{-- Form Update Status & Respon --}}
                            <form action="{{ route('keluhan.update', $msg->id) }}" method="POST" style="display: inline-flex; align-items: center; gap: 6px;">
                                @csrf
                                @method('PUT')
                                <select name="status" style="font-size: 11px; padding: 3px 6px; border-radius: 4px; border: 1px solid #cbd5e1;">
                                    <option value="menunggu" @selected($msg->status === 'menunggu')>Menunggu</option>
                                    <option value="sedang_diperbaiki" @selected($msg->status === 'sedang_diperbaiki')>Sedang Diperbaiki</option>
                                    <option value="selesai" @selected($msg->status === 'selesai')>Selesai</option>
                                </select>
                                <button type="submit" class="btn-card-action" style="padding: 2px 8px; font-size: 11px;">Simpan</button>
                            </form>
                        </div>
                        @if($msg->reply)
                            <div style="margin-top: 6px; background: #eff6ff; border-radius: 6px; padding: 6px 10px; font-size: 11.5px; color: #1e40af;">
                                <strong>Tanggapan Pengelola:</strong> {{ $msg->reply }}
                            </div>
                        @endif
                    </div>
                @empty
                    <div style="text-align: center; padding: 36px 20px; color: #64748b;">
                        <span style="font-size: 32px; display: block; margin-bottom: 8px;">🎉</span>
                        <strong>Tidak ada keluhan aktif</strong>
                        <p style="font-size: 12px; margin-top: 4px;">Seluruh fasilitas kamar dalam kondisi prima dan terawat.</p>
                    </div>
                @endforelse
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 16px; padding-top: 12px; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn-prop-outline" onclick="closeTicketsModal(); openComplaintModal();">
                    + Buat Tiket / Laporan Baru
                </button>
                <button type="button" class="btn-prop-primary" onclick="closeTicketsModal()">Tutup</button>
            </div>
        </div>
    </div>

    {{-- Script Interaktivitas & Responsive Sidebar --}}
    <script src="{{ asset('koshub.js') }}"></script>
    <script>
        // Modal functions
        function openComplaintModal() {
            document.getElementById('complaintModal').removeAttribute('hidden');
        }
        function closeComplaintModal() {
            document.getElementById('complaintModal').setAttribute('hidden', '');
        }
        function openTicketsModal() {
            document.getElementById('ticketsModal').removeAttribute('hidden');
        }
        function closeTicketsModal() {
            document.getElementById('ticketsModal').setAttribute('hidden', '');
        }

        // Room selection in detail drawer
        function selectRoom(num, type, price, status, tenant, cardElement) {
            document.querySelectorAll('.room-card').forEach(c => c.classList.remove('is-selected'));
            cardElement.classList.add('is-selected');

            document.getElementById('drawerRoomTitle').textContent = 'Kamar ' + num + ' (' + type + ')';
            document.getElementById('drawerRoomLoc').textContent = (num.startsWith('1') ? 'Lantai 1 • Sayap Samudra' : 'Lantai 2 • Sayap Angkasa');
            document.getElementById('drawerPriceMonth').textContent = price;
            document.getElementById('bookingUrlText').textContent = 'griyasamudra.koshub.id/kamar/' + num;

            const badge = document.getElementById('drawerStatusBadge');
            if (status === 'Siap Huni' || status === 'tersedia') {
                badge.className = 'drawer-pill-ready';
                badge.textContent = '● Siap Dihuni';
            } else if (status === 'Terisi') {
                badge.className = 'drawer-pill-ready';
                badge.style.background = '#dcfce7';
                badge.style.color = '#15803d';
                badge.textContent = '● Terisi (' + (tenant || 'Penyewa') + ')';
            } else {
                badge.className = 'drawer-pill-ready';
                badge.style.background = '#fee2e2';
                badge.style.color = '#b91c1c';
                badge.textContent = '🔧 Pemeliharaan';
            }
        }

        // Filter Floors
        function filterFloor(floor, btn) {
            document.querySelectorAll('.prop-filter-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');

            const f1 = document.getElementById('floor-1-card');
            const f2 = document.getElementById('floor-2-card');

            if (floor === 'all') {
                f1.style.display = 'block';
                f2.style.display = 'block';
            } else if (floor === '1') {
                f1.style.display = 'block';
                f2.style.display = 'none';
            } else if (floor === '2') {
                f1.style.display = 'none';
                f2.style.display = 'block';
            }
        }

        // Filter Status
        function filterStatus(status, btn) {
            document.querySelectorAll('.prop-status-pill').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');

            const cards = document.querySelectorAll('.room-card');
            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === 'all' || cardStatus === status) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Search Filter
        function filterRooms() {
            const query = document.getElementById('roomSearchInput').value.toLowerCase();
            const type = document.getElementById('typeSelect').value;
            const cards = document.querySelectorAll('.room-card');

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                const cardType = card.getAttribute('data-type');
                const matchesQuery = text.includes(query);
                const matchesType = (type === 'all' || cardType === type);

                if (matchesQuery && matchesType) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Copy Booking Link
        function copyBookingLink() {
            const url = document.getElementById('bookingUrlText').textContent;
            navigator.clipboard.writeText('https://' + url).then(() => {
                alert('Tautan booking berhasil disalin:\nhttps://' + url);
            }).catch(() => {
                prompt('Salin tautan booking:', 'https://' + url);
            });
        }

        // WhatsApp Share
        function shareWhatsApp() {
            const url = document.getElementById('bookingUrlText').textContent;
            const text = encodeURIComponent('Halo! Kamar kos di Griya Samudra siap dihuni. Cek detail dan booking langsung di sini: https://' + url);
            window.open('https://api.whatsapp.com/send?text=' + text, '_blank');
        }

        // Auto open complaint modal if URL hash is #keluhan
        if (window.location.hash === '#keluhan') {
            openComplaintModal();
        }
    </script>
</body>
</html>
