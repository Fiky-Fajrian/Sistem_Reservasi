<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tagihan & Meteran — KosHub</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('koshub.css') }}">
<style>
*{box-sizing:border-box}body{font-family:Inter,sans-serif;background:#f5f7fc;color:#17233b;margin:0}.app-layout{display:flex;min-height:100vh}.sidebar{width:245px;flex-shrink:0;background:#fff;border-right:1px solid #e6eaf2;padding:22px 16px;display:flex;flex-direction:column}.brand{display:flex;align-items:center;gap:10px;margin:0 8px 30px}.brand-icon{background:#2563eb;color:white;border-radius:9px;padding:9px 12px;font-weight:800}.brand h2{font-size:18px;margin:0}.brand span{font-size:10px;color:#8290a7}.menu-label{font-size:10px;font-weight:800;color:#9aa5b8;letter-spacing:1px;margin:12px 10px}.navigation{display:grid;gap:5px}.nav-link{padding:11px 12px;border-radius:8px;text-decoration:none;color:#5b6880;font-size:12px;font-weight:600}.nav-link.active,.nav-link:hover{background:#eaf1ff;color:#225bd7}.nav-icon{display:inline-block;width:23px}.side-bottom{margin-top:auto;font-size:11px;color:#8792a6;padding:12px}.main-content{flex:1;min-width:0}.topbar{height:68px;background:white;border-bottom:1px solid #e8ecf3;display:flex;align-items:center;justify-content:space-between;padding:0 30px}.crumb{font-size:12px;color:#8994a8}.crumb b{color:#26344d}.top-user{font-size:12px;font-weight:700}.page{padding:25px 30px 45px;max-width:1600px;margin:auto}.heading{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;margin-bottom:22px}.eyebrow{font-size:10px;font-weight:800;color:#5275bd;letter-spacing:1.2px}.heading h1{font-size:25px;margin:7px 0;color:#18243b}.heading p{font-size:12px;color:#78859b;margin:0;line-height:1.6}.actions{display:flex;gap:8px;flex-wrap:wrap}.btn{border:1px solid #dce3ef;background:#fff;color:#40516e;padding:10px 13px;border-radius:8px;font-size:11px;font-weight:700;cursor:pointer}.btn.primary{background:#2563eb;color:#fff;border-color:#2563eb}.cards{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:13px;margin-bottom:20px}.metric{background:#fff;border:1px solid #e8edf5;border-radius:11px;padding:16px;box-shadow:0 2px 8px #1c37600a}.metric-head{display:flex;justify-content:space-between;color:#71809a;font-size:10px;font-weight:700}.metric-icon{width:27px;height:27px;border-radius:8px;background:#edf3ff;color:#2763d9;display:grid;place-items:center;font-size:15px}.metric strong{display:block;font-size:23px;margin:10px 0 5px;color:#1d2b45}.metric small{font-size:10px;color:#71809a}.green{color:#15966b!important}.red{color:#dc4c4c!important}.progress{height:6px;background:#edf0f6;border-radius:8px;margin:9px 0 5px;overflow:hidden}.progress span{display:block;height:100%;width:92%;background:#18a879}.toolbar{background:#fff;border:1px solid #e7ecf4;border-radius:10px;padding:12px;display:flex;align-items:center;gap:9px;flex-wrap:wrap;margin-bottom:14px}.toolbar select,.toolbar input{border:1px solid #e0e6ef;border-radius:7px;padding:9px 11px;font:inherit;font-size:11px;color:#53617a;background:white}.toolbar input{margin-left:auto;min-width:220px}.tabs{display:flex;gap:5px;flex-wrap:wrap;margin-bottom:12px}.tab{padding:9px 13px;border:1px solid #e1e7f0;border-radius:8px;background:#fff;color:#68768e;font-size:11px;font-weight:700;cursor:pointer}.tab.active{background:#eaf1ff;border-color:#cbdcff;color:#245ed0}.table-wrap{overflow:auto;background:#fff;border:1px solid #e7ecf4;border-radius:10px}.data-table{width:100%;border-collapse:collapse;min-width:920px}.data-table th{background:#f4f7fc;color:#65748e;text-align:left;padding:12px 10px;font-size:9px;letter-spacing:.3px;white-space:nowrap}.data-table td{padding:13px 10px;border-top:1px solid #edf0f5;font-size:10px;color:#52617a;white-space:nowrap}.data-table td b{color:#23324c}.room{font-weight:800!important;color:#235bc7!important}.sub{display:block;font-size:9px;color:#96a0b1;margin-top:4px}.pill{display:inline-block;padding:4px 7px;border-radius:5px;font-size:9px;font-weight:800;background:#eaf7f1;color:#13845e}.pill.warn{background:#fff2e8;color:#c76a1d}.pill.pending{background:#fff6d9;color:#a77913}.pill.info{background:#eaf1ff;color:#3267c5}.table-foot{padding:12px 14px;color:#8994a8;font-size:10px}.lower{display:grid;grid-template-columns:1.6fr 1fr;gap:14px;margin-top:17px}.panel{background:#fff;border:1px solid #e7ecf4;border-radius:10px;padding:17px}.panel h3{font-size:13px;margin:0 0 5px;color:#25334d}.panel p{font-size:10px;color:#8994a8;margin:0}.bars{height:145px;display:flex;align-items:end;justify-content:space-around;gap:12px;padding:15px 10px 0;border-bottom:1px solid #e8edf5}.bar-group{height:100%;display:flex;align-items:end;gap:4px;position:relative}.bar{width:13px;border-radius:4px 4px 0 0;background:#5e88e8}.bar.water{background:#4d9bb7}.month{position:absolute;bottom:-19px;left:50%;transform:translateX(-50%);font-size:9px;color:#8490a5}.tariff{display:flex;justify-content:space-between;align-items:center;padding:13px 0;border-bottom:1px solid #edf0f5;font-size:10px;color:#738099}.tariff b{font-size:15px;color:#255fcf}.tariff:last-child{border:0}.note{font-size:10px;color:#7b879b;margin-top:22px}.modal{display:none;position:fixed;inset:0;background:#14213b80;z-index:10;align-items:center;justify-content:center;padding:18px}.modal.show{display:flex}.modal-box{width:100%;max-width:440px;background:white;border-radius:13px;padding:22px}.modal-box h3{margin:0 0 15px}.field{display:grid;gap:6px;margin:12px 0}.field label{font-size:11px;font-weight:700;color:#52617a}.field input,.field select{padding:10px;border:1px solid #dce3ed;border-radius:7px;font:inherit;font-size:12px}.modal-actions{display:flex;justify-content:flex-end;gap:8px;margin-top:18px}@media(max-width:950px){.sidebar{width:190px}.cards{grid-template-columns:repeat(2,1fr)}.lower{grid-template-columns:1fr}}@media(max-width:650px){.sidebar{display:none}.topbar{padding:0 16px}.page{padding:20px 14px}.heading{display:block}.actions{margin-top:14px}.cards{grid-template-columns:1fr 1fr}.metric strong{font-size:19px}.toolbar input{margin-left:0;width:100%}}@media(max-width:390px){.cards{grid-template-columns:1fr}}

/* Sidebar disamakan dengan sidebar utama pada properti/dashboard */
.sidebar {
    position: fixed !important;
    inset: 0 auto 0 0 !important;
    z-index: 100 !important;
    width: 260px !important;
    height: 100vh !important;
    padding: 25px 17px 15px !important;
    display: flex !important;
    flex-direction: column !important;
    background: #fff !important;
    border-right: 1px solid #e5eaf2 !important;
    overflow-y: auto !important;
}
.sidebar .brand { display:flex !important; align-items:center !important; gap:11px !important; padding:0 8px 30px !important; margin:0 !important; }
.sidebar .brand-icon { display:grid !important; place-items:center !important; width:42px !important; height:42px !important; padding:0 !important; border-radius:13px !important; background:#4f6df5 !important; color:#fff !important; font-size:23px !important; }
.sidebar .brand h2 { margin:0 0 4px !important; font-size:20px !important; color:#202b40 !important; }
.sidebar .brand span { display:block !important; color:#7d899c !important; font-size:10px !important; }
.sidebar .menu-label { margin:0 10px 12px !important; color:#9ba4b4 !important; font-size:10px !important; font-weight:800 !important; letter-spacing:1.1px !important; }
.sidebar .navigation { display:flex !important; flex-direction:column !important; gap:5px !important; flex:1 !important; }
.sidebar .nav-link { display:flex !important; align-items:center !important; gap:13px !important; min-height:44px !important; padding:0 12px !important; border-radius:9px !important; color:#68758a !important; font-size:13px !important; font-weight:500 !important; text-decoration:none !important; white-space:nowrap !important; }
.sidebar .nav-link:hover, .sidebar .nav-link.active { background:#edf2ff !important; color:#4f6df5 !important; }
.sidebar .nav-link.active { font-weight:700 !important; }
.sidebar .nav-icon { display:inline-flex !important; align-items:center !important; justify-content:center !important; width:20px !important; height:20px !important; font-size:17px !important; }
.sidebar .secondary-label { margin-top:27px !important; }
.sidebar .user-bottom { margin-top:auto !important; padding-top:16px !important; }
.sidebar .help-card { padding:15px !important; margin-bottom:17px !important; border:1px solid #e5ebff !important; border-radius:12px !important; background:#f6f8ff !important; }
.sidebar .help-card strong { display:block !important; font-size:12px !important; color:#26344d !important; }
.sidebar .help-card p { margin:6px 0 8px !important; color:#7d899c !important; font-size:11px !important; line-height:1.6 !important; }
.sidebar .help-card a { color:#4f6df5 !important; font-size:11px !important; font-weight:700 !important; text-decoration:none !important; }
.sidebar .user-profile { display:flex !important; align-items:center !important; gap:10px !important; padding:16px 5px 2px !important; border-top:1px solid #e5eaf2 !important; background:transparent !important; }
.sidebar .avatar { display:grid !important; place-items:center !important; width:37px !important; height:37px !important; border-radius:50% !important; background:#e5ecff !important; color:#4165d9 !important; font-size:12px !important; font-weight:700 !important; }
.sidebar .user-info { display:flex !important; flex-direction:column !important; gap:3px !important; flex:1 !important; }
.sidebar .user-info strong { font-size:11px !important; color:#26344d !important; }
.sidebar .user-info span { font-size:10px !important; color:#8994a8 !important; }
.sidebar .profile-menu { color:#8994a8 !important; }
.main-content { margin-left:260px !important; min-width:0 !important; }
@media(max-width:650px) { .sidebar { display:none !important; } .main-content { margin-left:0 !important; } }
</style>
</head><body><div class="app-layout">
<aside class="sidebar" id="sidebar">
    <div class="brand">
        <div class="brand-icon">K</div>
        <div>
            <h2>KosHub</h2>
            <span>Property Management</span>
        </div>
        <button class="close-sidebar" id="closeSidebar" aria-label="Tutup menu">×</button>
    </div>

    <div class="menu-label">MENU UTAMA</div>
    <nav class="navigation">
        <a href="/dashboard" class="nav-link">
            <span class="nav-icon">▦</span> DASHBOARD
        </a>
        <a href="/properti" class="nav-link">
            <span class="nav-icon">⌂</span> Properti Saya
        </a>
        <a href="#" class="nav-link">
            <span class="nav-icon">▤</span> Manajemen Kamar
        </a>
        <a href="#" class="nav-link">
            <span class="nav-icon">♙</span> Data Penghuni
        </a>
        <a href="{{ route('tagihan.index') }}" class="nav-link {{ $activePage === 'tagihan' ? 'active' : '' }}">
            <span class="nav-icon">▧</span> Tagihan &amp; Pembayaran
        </a>
        <a href="{{ route('meteran.index') }}" class="nav-link {{ $activePage === 'meteran' ? 'active' : '' }}">
            <span class="nav-icon">ϟ</span> Meteran
        </a>

        <div class="menu-label secondary-label">PENGELOLAAN</div>
        <a href="#" class="nav-link">
            <span class="nav-icon">♧</span> Manajemen Staf
        </a>
        <a href="#" class="nav-link">
            <span class="nav-icon">⚙</span> Pengaturan
        </a>
        <a href="#" class="nav-link">
            <span class="nav-icon">💬</span> Chat &amp; Keluhan
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
<main class="main-content"><header class="topbar"><div class="crumb">Beranda　/　Manajemen Tagihan & Billing　/　<b>Histori & Rekapitulasi Meteran</b></div><div class="top-user">Hendra Wijaya　 <span style="color:#8994a8;font-weight:400">Pemilik Kos</span></div></header>
<div class="page"><section class="heading"><div><div class="eyebrow">GRIYA SAMUDRA BANYUWANGI</div><h1>Histori & Rekapitulasi Meteran Utilitas</h1><p>Monitoring catatan kWh listrik dan volume m³ air bulanan seluruh kamar, integrasi tarif otomatis, dan audit verifikasi bukti fisik.</p></div><div class="actions"><button class="btn" onclick="window.print()">⇩ Ekspor Rekap (Excel/PDF)</button><button class="btn" onclick="alert('Pengingat tagihan disiapkan untuk penghuni.')">Kirim Pengingat Massal</button><button class="btn primary" onclick="openModal()">＋ Input Meteran Baru</button></div></section>
<section class="cards">
<div class="metric"><div class="metric-head">TOTAL KONSUMSI LISTRIK <span class="metric-icon">ϟ</span></div><strong>2.140 <small>kWh</small></strong><small class="green">↗ +6,2% vs Feb 2026</small><div class="sub">Flat Rp 1.500 / kWh · <b>Rp 3.210.000</b></div></div>
<div class="metric"><div class="metric-head">TOTAL KONSUMSI AIR PDAM <span class="metric-icon">◉</span></div><strong>84 <small>m³</small></strong><small class="green">↘ -3,1% vs Feb 2026</small><div class="sub">Tarif Rp 5.000 / m³ · <b>Rp 420.000</b></div></div>
<div class="metric"><div class="metric-head">PROGRES INPUT UNIT <span class="metric-icon">▤</span></div><strong>23 <small>/ 25 Unit</small></strong><div class="progress"><span></span></div><small>92% · 2 kamar belum input · <b class="green">1 Verifikasi</b></small></div>
<div class="metric"><div class="metric-head">TOTAL BEBAN TAGIHAN <span class="metric-icon">▣</span></div><strong><small>Rp</small> 3.630.000</strong><small>Otomatis digabung ke invoice pokok sewa</small><div class="sub"><span class="pill info">Siap terbit billing</span></div></div>
</section>
<div class="toolbar"><select id="period"><option>Maret 2026</option><option>Februari 2026</option><option>Januari 2026</option></select><select id="floor"><option value="all">Semua Lantai</option><option value="1">Lantai 1</option><option value="2">Lantai 2</option></select><select id="status"><option value="all">Semua Status</option><option value="verified">Terverifikasi</option><option value="pending">Pending Review</option><option value="missing">Belum Input</option></select><input id="search" placeholder="Cari nomor kamar atau penghuni..."></div>
<div class="tabs"><button class="tab active" data-tab="all">▦ Rekap Gabungan (Listrik & Air)</button><button class="tab" data-tab="electric">ϟ Histori Listrik Saja (kWh)</button><button class="tab" data-tab="water">◉ Histori Air PDAM (m³)</button><button class="tab" data-tab="anomaly">⚠ Anomali Pemakaian Tinggi</button></div>
<div class="table-wrap"><table class="data-table"><thead><tr><th>UNIT KAMAR</th><th>PENGHUNI & KONTAK</th><th>METER LISTRIK (kWh)</th><th>SUBTOTAL LISTRIK</th><th>METER AIR (m³)</th><th>SUBTOTAL AIR</th><th>TOTAL BILLING</th><th>BUKTI FOTO</th><th>STATUS</th></tr></thead><tbody id="meterRows">
<tr data-floor="1" data-status="verified" data-anomaly="no"><td><b class="room">Kamar 101</b><span class="sub">Lantai 1 • Deluxe AC</span></td><td><b>Zidane Mansoer</b><span class="sub">+62 821-4901-7721</span></td><td>120 → 158 <span class="pill info">+38</span></td><td><b>Rp 57.000</b></td><td>12 → 15 <span class="pill info">+3</span></td><td><b>Rp 15.000</b></td><td><b>Rp 72.000</b></td><td><span class="pill info">▣ 2 Foto</span></td><td><span class="pill">Terverifikasi</span></td></tr>
<tr data-floor="1" data-status="verified" data-anomaly="no"><td><b class="room">Kamar 102</b><span class="sub">Lantai 1 • Deluxe AC</span></td><td><b>Fiky Fajrian</b><span class="sub">+62 813-8821-4409</span></td><td>85 → 130 <span class="pill info">+45</span></td><td><b>Rp 67.500</b></td><td>14 → 18 <span class="pill info">+4</span></td><td><b>Rp 20.000</b></td><td><b>Rp 87.500</b></td><td><span class="pill info">▣ 2 Foto</span></td><td><span class="pill">Terverifikasi</span></td></tr>
<tr data-floor="1" data-status="verified" data-anomaly="no"><td><b class="room">Kamar 103</b><span class="sub">Lantai 1 • Standard Non-AC</span></td><td><b>Kosong (Standby Unit)</b><span class="sub">Siap Huni</span></td><td>42 → 45 <span class="pill info">+3</span></td><td><b>Rp 4.500</b></td><td>8 → 8 <span class="pill info">0</span></td><td><b>Rp 0</b></td><td><b>Rp 4.500</b></td><td><span class="pill info">▣ 1 Foto</span></td><td><span class="pill">Terverifikasi</span></td></tr>
<tr data-floor="1" data-status="pending" data-anomaly="yes"><td><b class="room">Kamar 104</b><span class="sub">Lantai 1 • Deluxe AC Balcony</span></td><td><b>Budi Santoso</b><span class="sub">+62 852-3312-9908</span></td><td>98 → 172 <span class="pill warn">+74 kWh</span></td><td><b class="red">Rp 111.000</b></td><td>20 → 27 <span class="pill warn">+7 m³</span></td><td><b>Rp 35.000</b></td><td><b class="red">Rp 146.000</b></td><td><span class="pill warn">Review Staf</span></td><td><span class="pill pending">Pending Review</span></td></tr>
<tr data-floor="2" data-status="verified" data-anomaly="no"><td><b class="room">Kamar 201</b><span class="sub">Lantai 2 • Suite King Bed</span></td><td><b>Rian Pratama</b><span class="sub">+62 878-1122-3041</span></td><td>110 → 152 <span class="pill info">+42</span></td><td><b>Rp 63.000</b></td><td>16 → 19 <span class="pill info">+3</span></td><td><b>Rp 15.000</b></td><td><b>Rp 78.000</b></td><td><span class="pill info">▣ 2 Foto</span></td><td><span class="pill">Terverifikasi</span></td></tr>
<tr data-floor="2" data-status="missing" data-anomaly="no"><td><b class="room">Kamar 202</b><span class="sub">Lantai 2 • Suite Balcony</span></td><td><b>Dimas Arya</b><span class="sub">+62 812-7788-2190</span></td><td colspan="2">Belum diinput</td><td colspan="2">Belum diinput</td><td>—</td><td>—</td><td><span class="pill pending">Belum Input</span></td></tr>
<tr data-floor="2" data-status="verified" data-anomaly="no"><td><b class="room">Kamar 204</b><span class="sub">Lantai 2 • Suite AC Plus</span></td><td><b>Aditya R.</b><span class="sub">+62 857-1940-2218</span></td><td>210 → 275 <span class="pill info">+65</span></td><td><b>Rp 97.500</b></td><td>22 → 26 <span class="pill info">+4</span></td><td><b>Rp 20.000</b></td><td><b>Rp 117.500</b></td><td><span class="pill info">▣ 2 Foto</span></td><td><span class="pill">Terverifikasi</span></td></tr>
</tbody></table><div class="table-foot" id="rowCount">Menampilkan 1–7 dari 25 total kamar aktif　　Sebelumnya　 1　 2　 3　 Berikutnya</div></div>
<div class="lower"><section class="panel"><h3>Trend Historis Konsumsi (6 Bulan Terakhir)</h3><p>Rata-rata penggunaan kWh listrik & volume air per kamar Griya Samudra</p><div class="bars"><div class="bar-group"><i class="bar" style="height:65%"></i><i class="bar water" style="height:52%"></i><span class="month">Okt 25</span></div><div class="bar-group"><i class="bar" style="height:70%"></i><i class="bar water" style="height:58%"></i><span class="month">Nov 25</span></div><div class="bar-group"><i class="bar" style="height:88%"></i><i class="bar water" style="height:79%"></i><span class="month">Des 25</span></div><div class="bar-group"><i class="bar" style="height:68%"></i><i class="bar water" style="height:62%"></i><span class="month">Jan 26</span></div><div class="bar-group"><i class="bar" style="height:78%"></i><i class="bar water" style="height:66%"></i><span class="month">Feb 26</span></div><div class="bar-group"><i class="bar" style="height:94%"></i><i class="bar water" style="height:72%"></i><span class="month">Mar 26</span></div></div><div class="note">■ Listrik (kWh)　 ■ Air PDAM (m³)　 · Efisiensi energi stabil, kenaikan sebanding tingkat hunian kamar 96%.</div></section>
<section class="panel"><h3>Konfigurasi Tarif Aktif</h3><p>Tarif per unit pemakaian</p><div class="tariff"><span>ϟ Tarif Flat Listrik<br><small>Per kWh (Prabayar/Pascabayar)</small></span><b>Rp 1.500</b></div><div class="tariff"><span>◉ Tarif Air PDAM<br><small>Per meter kubik (m³)</small></span><b>Rp 5.000</b></div><div class="tariff"><span>▣ Fonnte WA Gateway<br><small>Pengingat H-3 Otomatis</small></span><span class="pill">AKTIF</span></div><div class="note">Update terakhir: 1 Maret 2026　 <a href="#" onclick="alert('Pengaturan tarif dapat disesuaikan oleh pemilik kos.');return false;">Ubah Tarif Unit</a></div></section></div>
</div></main></div>
<div class="modal" id="meterModal"><div class="modal-box"><h3>Input Meteran Baru</h3><form id="meterForm"><div class="field"><label>Nomor Kamar</label><select required><option value="">Pilih kamar</option><option>Kamar 101</option><option>Kamar 102</option><option>Kamar 103</option><option>Kamar 104</option><option>Kamar 201</option><option>Kamar 202</option><option>Kamar 204</option></select></div><div class="field"><label>Meter Listrik (kWh)</label><input type="number" min="0" placeholder="Angka meter terbaru" required></div><div class="field"><label>Meter Air (m³)</label><input type="number" min="0" placeholder="Angka meter terbaru" required></div><div class="field"><label>Bukti Foto Meteran</label><input type="file" accept="image/*"></div><div class="modal-actions"><button type="button" class="btn" onclick="closeModal()">Batal</button><button class="btn primary" type="submit">Simpan Input</button></div></form></div></div>
<script>
const rows=[...document.querySelectorAll('#meterRows tr')];let activeTab='all';
function filterRows(){const q=document.getElementById('search').value.toLowerCase(),f=document.getElementById('floor').value,s=document.getElementById('status').value;let n=0;rows.forEach(r=>{const okText=r.innerText.toLowerCase().includes(q),okFloor=f==='all'||r.dataset.floor===f,okStatus=s==='all'||r.dataset.status===s,okTab=activeTab==='all'||(activeTab==='anomaly'?r.dataset.anomaly==='yes':activeTab==='electric'?true:true);r.style.display=okText&&okFloor&&okStatus&&okTab?'':'none';if(r.style.display!=='none')n++});document.getElementById('rowCount').textContent=`Menampilkan ${n} data sesuai filter dari 25 total kamar aktif`;}
document.querySelectorAll('.toolbar select,#search').forEach(el=>el.addEventListener('input',filterRows));document.querySelectorAll('.tab').forEach(b=>b.addEventListener('click',()=>{document.querySelectorAll('.tab').forEach(x=>x.classList.remove('active'));b.classList.add('active');activeTab=b.dataset.tab;filterRows()}));
function openModal(){document.getElementById('meterModal').classList.add('show')}function closeModal(){document.getElementById('meterModal').classList.remove('show')}document.getElementById('meterModal').addEventListener('click',e=>{if(e.target.id==='meterModal')closeModal()});document.getElementById('meterForm').addEventListener('submit',e=>{e.preventDefault();alert('Data input meteran berhasil disiapkan. Untuk menyimpan permanen, perlu dihubungkan ke database meteran.');closeModal();e.target.reset()});
</script></body></html>
