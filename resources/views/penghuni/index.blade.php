
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penghuni — KosHub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('koshub.css') }}">
    <link rel="stylesheet" href="{{ asset('properti.css') }}">

    <style>
        .tenant-toolbar {
            display:flex; justify-content:space-between;
            align-items:center; gap:12px; flex-wrap:wrap;
            margin:22px 0;
        }
        .tenant-search {
            display:flex; align-items:center; gap:10px;
            background:#fff; border:1px solid #e2e8f0;
            border-radius:10px; padding:11px 14px;
            min-width:260px; flex:1;
        }
        .tenant-search input {
            border:0; outline:0; width:100%; font:inherit;
        }
        .tenant-table-wrap {
            background:#fff; border:1px solid #e2e8f0;
            border-radius:14px; overflow-x:auto;
        }
        .tenant-table {
            width:100%; border-collapse:collapse;
            min-width:850px;
        }
        .tenant-table th {
            background:#f8fafc; color:#64748b;
            font-size:11px; text-transform:uppercase;
            letter-spacing:.5px; text-align:left;
            padding:16px; white-space:nowrap;
        }
        .tenant-table td {
            padding:16px; border-top:1px solid #f1f5f9;
            font-size:13px; color:#334155;
        }
        .tenant-name {font-weight:700;color:#1e293b;}
        .tenant-sub {font-size:11px;color:#94a3b8;margin-top:4px;}
        .tenant-status {
            display:inline-block; padding:5px 10px;
            border-radius:20px; font-size:11px;font-weight:700;
            background:#dcfce7;color:#15803d;
        }
        .tenant-status.nonaktif {background:#fee2e2;color:#b91c1c;}
        .tenant-actions {display:flex;gap:7px;}
        .tenant-actions button {
            border:0;border-radius:7px;padding:7px 10px;
            cursor:pointer;font-size:12px;font-weight:600;
        }
        .edit-btn {background:#eff6ff;color:#2563eb;}
        .delete-btn {background:#fef2f2;color:#dc2626;}
        .tenant-modal {
            display:none;position:fixed;inset:0;
            background:rgba(15,23,42,.55);z-index:1000;
            align-items:center;justify-content:center;padding:16px;
        }
        .tenant-modal.show {display:flex;}
        .tenant-modal-content {
            background:#fff;width:100%;max-width:650px;
            max-height:90vh;overflow-y:auto;
            border-radius:16px;padding:25px;
        }
        .tenant-modal-header {
            display:flex;justify-content:space-between;
            align-items:center;margin-bottom:20px;
        }
        .tenant-modal-header h2 {font-size:19px;margin:0;color:#1e293b;}
        .tenant-close {
            border:0;background:#f1f5f9;border-radius:8px;
            width:32px;height:32px;cursor:pointer;font-size:20px;
        }
        .tenant-form-grid {
            display:grid;grid-template-columns:1fr 1fr;gap:15px;
        }
        .tenant-field {display:flex;flex-direction:column;gap:7px;}
        .tenant-field.full {grid-column:1/-1;}
        .tenant-field label {font-size:12px;font-weight:600;color:#475569;}
        .tenant-field input,.tenant-field select,.tenant-field textarea {
            width:100%;box-sizing:border-box;padding:11px;
            border:1px solid #cbd5e1;border-radius:8px;
            font:inherit;font-size:13px;outline-color:#2563eb;
        }
        .tenant-field textarea {min-height:75px;resize:vertical;}
        .tenant-form-actions {
            display:flex;justify-content:flex-end;gap:10px;margin-top:22px;
        }
        .tenant-form-actions button {
            padding:10px 17px;border-radius:8px;
            border:0;cursor:pointer;font-weight:600;
        }
        .cancel-btn {background:#f1f5f9;color:#475569;}
        .save-btn {background:#2563eb;color:#fff;}
        .tenant-alert {
            padding:13px 16px;border-radius:9px;margin-bottom:18px;
            background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;
            font-size:13px;
        }
        .tenant-error {color:#dc2626;font-size:11px;}
        .empty-data {text-align:center;padding:45px;color:#94a3b8;}
        @media(max-width:650px) {
            .tenant-form-grid {grid-template-columns:1fr;}
            .tenant-field.full {grid-column:auto;}
            .tenant-toolbar {align-items:stretch;}
            .tenant-search {min-width:0;}
        }
    </style>
</head>

<body>
<div class="app-layout">

    <!-- SIDEBAR -->
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
            <a href="{{ route('dashboard') }}" class="nav-link">
                <span class="nav-icon">▦</span> DASHBOARD
            </a>
            <a href="{{ route('properti.index') }}" class="nav-link">
                <span class="nav-icon">⌂</span> Properti Saya
            </a>
            <a href="{{ route('kamar.index') }}" class="nav-link">
                <span class="nav-icon">▤</span> Manajemen Kamar
            </a>
            <a href="{{ route('penghuni.index') }}" class="nav-link active">
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
            <a href="{{ route('properti.index') }}#keluhan" class="nav-link">
                <span class="nav-icon">💬</span> Chat & Keluhan
            </a>
        </nav>

        <div class="user-bottom">
            <div class="help-card">
                <strong>Butuh bantuan?</strong>
                <p>Kelola kos jadi lebih mudah bersama KosHub</p>
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

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" id="menuToggle">☰</button>
                <div class="breadcrumb">
                    Halaman <span>/</span> <strong>Data Penghuni</strong>
                </div>
            </div>

            <div class="topbar-right">
                <div class="topbar-divider"></div>
                <div class="mini-profile">{{ auth()->check() ? strtoupper(mb_substr(auth()->user()->name, 0, 2)) : 'FP' }}</div>
                <div class="topbar-user">
                    <strong>{{ auth()->user()->name ?? 'Pemilik Kos' }}</strong>
                    <span>Administrator</span>
                </div>
            </div>
        </header>

        <div class="page-content">

            <!-- JUDUL HALAMAN -->
            <section class="welcome-section">
                <div>
                    <div class="eyebrow">MANAJEMEN PENGHUNI</div>
                    <h1>Data Penghuni Kos</h1>
                    <p>Kelola informasi penghuni, identitas, kamar, dan status masa tinggal dalam satu tempat.</p>
                </div>

                <button type="button" class="primary-button" onclick="openAddModal()">
                    + Tambah Penghuni
                </button>
            </section>

            <!-- PESAN -->
            @if(session('success'))
                <div class="tenant-alert">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="tenant-alert" style="background:#fef2f2;color:#b91c1c;border-color:#fecaca;">
                    <strong>Data belum berhasil disimpan:</strong>
                    <ul style="margin:8px 0 0 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- STATISTIK -->
            <section class="section-heading">
                <div>
                    <h2>Ringkasan Penghuni</h2>
                    <p>Informasi jumlah penghuni yang tercatat di sistem.</p>
                </div>
            </section>

            <section class="stats-grid">
                <article class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Total Penghuni</span>
                        <div class="stat-icon blue">♙</div>
                    </div>
                    <div class="stat-value">{{ $penghuni->count() }}</div>
                    <div class="stat-footer">Seluruh data penghuni</div>
                </article>

                <article class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Penghuni Aktif</span>
                        <div class="stat-icon green">✓</div>
                    </div>
                    <div class="stat-value">
                        {{ $penghuni->filter(fn($p) => strtolower($p->status_penghuni ?? '') === 'aktif')->count() }}
                    </div>
                    <div class="stat-footer">Status aktif</div>
                </article>

                <article class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Penghuni Nonaktif</span>
                        <div class="stat-icon orange">−</div>
                    </div>
                    <div class="stat-value">
                        {{ $penghuni->filter(fn($p) => strtolower($p->status_penghuni ?? '') === 'nonaktif')->count() }}
                    </div>
                    <div class="stat-footer">Status nonaktif</div>
                </article>

                <article class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Data Kos</span>
                        <div class="stat-icon purple">⌂</div>
                    </div>
                    <div class="stat-value">{{ $kosList->count() }}</div>
                    <div class="stat-footer">Kos terdaftar</div>
                </article>
            </section>

            <!-- PENCARIAN DAN TOMBOL -->
            <section class="section-heading" style="margin-top:30px;">
                <div>
                    <h2>Daftar Penghuni</h2>
                    <p>Daftar seluruh penghuni yang tersimpan dalam database.</p>
                </div>
            </section>

            <div class="tenant-toolbar">
                <div class="tenant-search">
                    <span>⌕</span>
                    <input type="text" id="searchTenant"
                           placeholder="Cari nama, NIK, nomor kamar..."
                           oninput="searchTenants()">
                </div>
                <button type="button" class="primary-button" onclick="openAddModal()">
                    + Tambah Penghuni
                </button>
            </div>

            <!-- TABEL PENGHUNI -->
            <div class="tenant-table-wrap">
                <table class="tenant-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Penghuni</th>
                            <th>NIK</th>
                            <th>Nomor HP</th>
                            <th>Kamar</th>
                            <th>Mulai Menempati</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="tenantTableBody">
                        @forelse($penghuni as $index => $item)
                            <tr class="tenant-row">
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <div class="tenant-name">
                                        {{ $item->nama_penyewa }}
                                    </div>
                                    <div class="tenant-sub">
                                        ID Penghuni: {{ $item->id }}
                                    </div>
                                </td>

                                <td>{{ $item->nik ?: '-' }}</td>
                                <td>{{ $item->nomor_hp ?: '-' }}</td>
                                <td>
                                    <strong>{{ $item->nomor_kamar }}</strong>
                                </td>
                                <td>
                                    {{ $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') : '-' }}
                                </td>
                                <td>{{ $item->durasi_bulan }} bulan</td>

                                <td>
                                    <span class="tenant-status {{ strtolower($item->status_penghuni ?? 'aktif') === 'nonaktif' ? 'nonaktif' : '' }}">
                                        {{ $item->status_penghuni ?? 'Aktif' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="tenant-actions">
                                        <button type="button" class="edit-btn"
                                            onclick="openEditModal(this)"
                                            data-id="{{ $item->id }}"
                                            data-nama="{{ $item->nama_penyewa }}"
                                            data-nik="{{ $item->nik }}"
                                            data-hp="{{ $item->nomor_hp }}"
                                            data-alamat="{{ $item->alamat_penghuni }}"
                                            data-kos="{{ $item->id_kos }}"
                                            data-kamar="{{ $item->nomor_kamar }}"
                                            data-tanggal="{{ $item->tanggal_mulai }}"
                                            data-durasi="{{ $item->durasi_bulan }}"
                                            data-status="{{ $item->status_penghuni }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('penghuni.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus penghuni ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-data">
                                        <div style="font-size:35px;margin-bottom:10px;">♙</div>
                                        <strong>Belum ada data penghuni</strong>
                                        <p>Silakan klik Tambah Penghuni untuk memasukkan data pertama.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>

<!-- MODAL TAMBAH / EDIT -->
<div class="tenant-modal" id="tenantModal">
    <div class="tenant-modal-content">
        <div class="tenant-modal-header">
            <h2 id="modalTitle">Tambah Penghuni</h2>
            <button type="button" class="tenant-close" onclick="closeTenantModal()">×</button>
        </div>

        <form id="tenantForm" action="{{ route('penghuni.store') }}" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <div class="tenant-form-grid">

                <div class="tenant-field">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama_penyewa" id="nama_penyewa" required>
                </div>

                <div class="tenant-field">
                    <label>NIK</label>
                    <input type="text" name="nik" id="nik" maxlength="16">
                </div>

                <div class="tenant-field">
                    <label>Nomor HP</label>
                    <input type="text" name="nomor_hp" id="nomor_hp">
                </div>

                <div class="tenant-field">
                    <label>Nomor Kamar *</label>
                    <input type="text" name="nomor_kamar" id="nomor_kamar" required>
                </div>

                <div class="tenant-field full">
                    <label>Alamat Penghuni</label>
                    <textarea name="alamat_penghuni" id="alamat_penghuni"></textarea>
                </div>

                <div class="tenant-field">
                    <label>Pilih Kos *</label>
                    <select name="id_kos" id="id_kos" required>
                        <option value="">-- Pilih Kos --</option>
                        @foreach($kosList as $kos)
                            <option value="{{ $kos->id }}">
                                {{ $kos->nama_kos ?? ('Kos #' . $kos->id) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="tenant-field">
                    <label>Tanggal Mulai *</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" required>
                </div>

                <div class="tenant-field">
                    <label>Durasi (Bulan) *</label>
                    <input type="number" name="durasi_bulan" id="durasi_bulan" min="1" required>
                </div>

                <div class="tenant-field">
                    <label>Status Penghuni</label>
                    <select name="status_penghuni" id="status_penghuni">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

            </div>

            <div class="tenant-form-actions">
                <button type="button" class="cancel-btn" onclick="closeTenantModal()">
                    Batal
                </button>
                <button type="submit" class="save-btn">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('tenantModal');
    const form = document.getElementById('tenantForm');

    function openAddModal() {
        form.reset();
        form.action = "{{ route('penghuni.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('modalTitle').textContent = 'Tambah Penghuni';
        modal.classList.add('show');
    }

    function openEditModal(button) {
        const data = button.dataset;

        form.reset();
        form.action = "/penghuni/" + data.id;

        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('modalTitle').textContent = 'Edit Data Penghuni';

        document.getElementById('nama_penyewa').value = data.nama || '';
        document.getElementById('nik').value = data.nik || '';
        document.getElementById('nomor_hp').value = data.hp || '';
        document.getElementById('alamat_penghuni').value = data.alamat || '';
        document.getElementById('id_kos').value = data.kos || '';
        document.getElementById('nomor_kamar').value = data.kamar || '';
        document.getElementById('tanggal_mulai').value = data.tanggal || '';
        document.getElementById('durasi_bulan').value = data.durasi || '';
        document.getElementById('status_penghuni').value = data.status || 'Aktif';

        modal.classList.add('show');
    }

    function closeTenantModal() {
        modal.classList.remove('show');
    }

    modal.addEventListener('click', function(event) {
        if (event.target === modal) closeTenantModal();
    });

    function searchTenants() {
        const keyword = document.getElementById('searchTenant').value.toLowerCase();
        const rows = document.querySelectorAll('.tenant-row');

        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(keyword)
                ? ''
                : 'none';
        });
    }

    // Menu sidebar untuk tampilan mobile
    const menuToggle = document.getElementById('menuToggle');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebar');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    }

    if (closeSidebar) {
        closeSidebar.addEventListener('click', () => sidebar.classList.remove('open'));
    }
</script>

</body>
</html>
