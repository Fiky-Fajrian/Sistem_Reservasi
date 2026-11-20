
@component('Components.layouts.landing')

    {{-- =====================================================
         HERO / BERANDA
    ====================================================== --}}
    <section class="lp-hero" id="beranda">
        <div class="lp-container lp-hero-inner">
            <h1>Temukan Kos Impianmu<br>dengan Mudah</h1>

            <p>
                Cari, pilih, dan pesan kos terbaik sesuai kebutuhanmu.<br>
                Kini lebih praktis dengan pembayaran online.
            </p>

            <form class="lp-search"
                  action="{{ route('landing') }}"
                  method="GET"
                  role="search">

                <div class="lp-search-field">
                    <label for="lpSearchQ">Nama kos</label>
                    <input
                        id="lpSearchQ"
                        type="text"
                        name="q"
                        placeholder="Cari nama kos..."
                        value="{{ $filters['q'] ?? '' }}"
                        autocomplete="off">
                </div>

                <div class="lp-search-sep" aria-hidden="true"></div>

                <div class="lp-search-field">
                    <label for="lpSearchLokasi">Lokasi</label>
                    <select id="lpSearchLokasi" name="lokasi">
                        <option value="semua">Pilih lokasi</option>

                        @foreach ($locations as $loc)
                            <option
                                value="{{ $loc }}"
                                @selected(($filters['lokasi'] ?? 'semua') === $loc)>
                                {{ $loc }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="lp-search-sep" aria-hidden="true"></div>

                <div class="lp-search-field">
                    <label for="lpSearchHarga">Kisaran harga</label>
                    <select id="lpSearchHarga" name="harga">
                        @foreach ($priceOptions as $key => $opt)
                            <option
                                value="{{ $key }}"
                                @selected(($filters['harga'] ?? 'semua') === $key)>
                                {{ $opt['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="lp-btn lp-btn--primary lp-search-submit">
                    <svg viewBox="0 0 24 24"
                         width="16"
                         height="16"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2.4"
                         stroke-linecap="round"
                         aria-hidden="true">
                        <circle cx="11" cy="11" r="7"/>
                        <path d="m20 20-3.2-3.2"/>
                    </svg>
                    Cari
                </button>
            </form>
        </div>
    </section>


    {{-- =====================================================
         DAFTAR KOS POPULER
    ====================================================== --}}
    <section class="lp-section" id="daftar-kos">
        <div class="lp-container">

            <div class="lp-section-head">
                <div>
                    <h2>Kos Populer</h2>

                    <p>
                        {{ ($filters['q'] ?? '') !== '' ||
                           ($filters['lokasi'] ?? 'semua') !== 'semua' ||
                           ($filters['harga'] ?? 'semua') !== 'semua'
                            ? 'Hasil pencarianmu:'
                            : 'Kos terbaik yang paling sering dicari penyewa.' }}
                    </p>
                </div>

                <a href="{{ route('landing') }}#daftar-kos"
                   class="lp-seeall">
                    Lihat Semua →
                </a>
            </div>


            @if ($kosList->isEmpty())

                <div class="lp-empty">
                    <span aria-hidden="true">🔍</span>

                    <h3>Tidak ada kos yang cocok</h3>

                    <p>
                        Coba ubah kata kunci atau hapus filter pencarianmu.
                    </p>

                    <a href="{{ route('landing') }}#daftar-kos"
                       class="lp-btn lp-btn--ghost">
                        Reset pencarian
                    </a>
                </div>

            @else

                <div class="lp-grid">

                    @foreach ($kosList as $kos)

                        @php
                            $fasilitas = array_filter(
                                array_slice(
                                    array_map(
                                        'trim',
                                        explode(',', (string) $kos->fasilitas)
                                    ),
                                    0,
                                    3
                                )
                            );
                        @endphp

                        <article class="lp-card">

                            <div class="lp-card-media lp-media-{{ ($loop->index % 3) + 1 }}">

                                <span class="lp-badge {{ $kos->status === 'tersedia' ? 'lp-badge--success' : 'lp-badge--warning' }}">
                                    {{ $kos->status === 'tersedia' ? 'Tersedia' : 'Terbatas' }}
                                </span>

                                <span class="lp-card-art" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"
                                         width="34"
                                         height="34"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.6"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M3 10.5 12 3l9 7.5"/>
                                        <path d="M5 9.5V21h14V9.5"/>
                                        <path d="M10 21v-6h4v6"/>
                                    </svg>
                                </span>

                                <span class="lp-chip lp-chip--glass">
                                    <svg viewBox="0 0 24 24"
                                         width="12"
                                         height="12"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="2.4"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         aria-hidden="true">
                                        <path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11Z"/>
                                        <circle cx="12" cy="10" r="2.5"/>
                                    </svg>

                                    {{ $kos->lokasi }}
                                </span>

                                <span class="lp-price-pill">
                                    Rp {{ number_format($kos->harga, 0, ',', '.') }}
                                    <small>/bln</small>
                                </span>

                            </div>


                            <div class="lp-card-body">

                                <div class="lp-card-top">
                                    <h3>{{ $kos->nama_kos }}</h3>
                                    <span class="lp-rate" title="Rating">★ 4.8</span>
                                </div>

                                <p class="lp-card-addr">
                                    {{ $kos->alamat }}
                                </p>

                                <ul class="lp-chips">
                                    @forelse ($fasilitas as $fas)
                                        <li>{{ $fas }}</li>
                                    @empty
                                        <li>Fasilitas belum tersedia</li>
                                    @endforelse
                                </ul>

                                <div class="lp-card-foot">

                                    <div class="lp-card-price">
                                        <strong>
                                            Rp {{ number_format($kos->harga, 0, ',', '.') }}
                                        </strong>
                                        <span>/Bulan</span>
                                    </div>

                                    <button
                                        type="button"
                                        class="lp-btn lp-btn--primary"
                                        data-detail="{{ $kos->id }}">
                                        Detail
                                    </button>

                                </div>
                            </div>

                        </article>

                    @endforeach

                </div>

            @endif

        </div>
    </section>


    {{-- =====================================================
         TENTANG KAMI
    ====================================================== --}}
    <section class="lp-section lp-about" id="tentang-kami">

        <div class="lp-container">

            <div class="lp-section-head">
                <div>
                    <h2>Tentang Kami</h2>
                    <p>
                        Cara baru mencari dan mengelola kos yang rapi,
                        jujur, dan cepat.
                    </p>
                </div>
            </div>

            <div class="lp-about-grid">

                <div class="lp-about-item">
                    <span class="lp-about-icon">🔍</span>
                    <h3>Cari & Filter Praktis</h3>
                    <p>
                        Filter berdasarkan nama kos, lokasi,
                        dan kisaran harga bulanan.
                    </p>
                </div>

                <div class="lp-about-item">
                    <span class="lp-about-icon">🔒</span>
                    <h3>Reservasi Aman</h3>
                    <p>
                        Reservasi hanya untuk akun penyewa yang sudah login.
                        Data tetap terlindungi.
                    </p>
                </div>

                <div class="lp-about-item">
                    <span class="lp-about-icon">👑</span>
                    <h3>Role Terkelola</h3>
                    <p>
                        Pemilik kos mendapat hak akses khusus dari
                        Super Admin melalui email resmi yang sudah ditentukan.
                    </p>
                </div>

            </div>

        </div>
    </section>


    {{-- =====================================================
         DATA KOS UNTUK JAVASCRIPT
         Menggunakan atribut HTML agar tidak tercampur
         dengan sintaks JavaScript.
    ====================================================== --}}
    <div
    id="lpKosData"
    hidden
    data-kos='{{ json_encode($kosList->values(), JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG) }}'
    data-logged-in="{{ auth()->check() ? '1' : '0' }}"
    data-penyewa="{{ auth()->check() && auth()->user()->role === \App\Models\User::ROLE_PENYEWA ? '1' : '0' }}">
</div>


    {{-- =====================================================
         MODAL LOGIN
    ====================================================== --}}
    <div
        class="lp-modal"
        id="lpLoginModal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="lpLoginTitle"
        hidden>

        <div class="lp-modal-backdrop" data-close></div>

        <div class="lp-modal-panel">

            <button type="button"
                    class="lp-modal-close"
                    data-close
                    aria-label="Tutup dialog">
                ×
            </button>

            <span class="lp-modal-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"
                     width="26"
                     height="26"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <rect x="4" y="11" width="16" height="9" rx="2"/>
                    <path d="M8 11V7a4 4 0 1 1 8 0v4"/>
                </svg>
            </span>

            <h3 id="lpLoginTitle">Masuk dulu, yuk!</h3>

            <p>
                Kamu harus login sebagai
                <strong>penyewa</strong>
                untuk melakukan reservasi kos.
            </p>

            <div class="lp-modal-actions">

                <a href="{{ route('login') }}"
                   class="lp-btn lp-btn--primary"
                   id="lpLoginModalLogin">
                    Masuk Sekarang
                </a>

                <a href="{{ route('register') }}"
                   class="lp-btn lp-btn--ghost">
                    Daftar Akun
                </a>

            </div>

        </div>
    </div>


    {{-- =====================================================
         MODAL DETAIL KOS
    ====================================================== --}}
    <div
        class="lp-modal"
        id="lpDetailModal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="lpDetailTitle"
        hidden>

        <div class="lp-modal-backdrop" data-close></div>

        <div class="lp-modal-panel lp-modal-panel--wide">

            <button type="button"
                    class="lp-modal-close"
                    data-close
                    aria-label="Tutup dialog">
                ×
            </button>

            <div class="lp-detail-media" id="lpDetailMedia">
                🏠
            </div>

            <div class="lp-detail-body">

                <div class="lp-detail-head">
                    <h3 id="lpDetailTitle">—</h3>
                    <span class="lp-badge" id="lpDetailBadge">—</span>
                </div>

                <p class="lp-detail-addr" id="lpDetailAddr">—</p>

                <div class="lp-detail-facts">

                    <div>
                        <span>Lokasi</span>
                        <strong id="lpDetailLokasi">—</strong>
                    </div>

                    <div>
                        <span>Total kamar</span>
                        <strong id="lpDetailKamar">—</strong>
                    </div>

                    <div>
                        <span>Harga</span>
                        <strong id="lpDetailHarga">—</strong>
                    </div>

                </div>

                <ul class="lp-chips lp-chips--detail"
                    id="lpDetailFasilitas">
                </ul>

                <div class="lp-detail-actions">

                    <button type="button"
                            class="lp-btn lp-btn--ghost"
                            data-close>
                        Batal
                    </button>

                    <a href="#"
                       class="lp-btn lp-btn--primary"
                       id="lpDetailReserve"
                       data-gate>
                        Ajukan Reservasi
                    </a>

                </div>

            </div>
        </div>
    </div>


    {{-- =====================================================
         CHAT DAN KELUHAN PENYEWA
    ====================================================== --}}
    @if (
        auth()->check() &&
        auth()->user()->role === \App\Models\User::ROLE_PENYEWA
    )

        <button
            type="button"
            class="lp-chat-fab"
            id="lpOpenComplaint"
            title="Kirim Chat / Keluhan ke Pengelola"
            style="position:fixed;bottom:24px;right:24px;z-index:999;background:#2563eb;color:#fff;border:none;border-radius:50px;padding:12px 20px;font-weight:700;font-size:13.5px;box-shadow:0 4px 16px rgba(37,99,235,0.4);display:flex;align-items:center;gap:8px;cursor:pointer;">

            <span aria-hidden="true">💬</span>
            <span>Chat & Keluhan</span>

        </button>


        <div
            class="lp-modal"
            id="lpComplaintModal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="lpComplaintTitle"
            hidden>

            <div class="lp-modal-backdrop" data-close></div>

            <div class="lp-modal-panel"
                 style="max-width:480px;text-align:left;">

                <button type="button"
                        class="lp-modal-close"
                        data-close
                        aria-label="Tutup dialog">
                    ×
                </button>

                <h3 id="lpComplaintTitle"
                    style="margin-bottom:4px;font-size:18px;font-weight:700;">
                    💬 Kirim Keluhan ke Pengelola
                </h3>

                <p style="font-size:13px;color:#64748b;margin-bottom:16px;">
                    Ada kendala fasilitas, AC, air, atau kelistrikan?
                    Sampaikan kepada pengelola kos.
                </p>

                <form action="{{ route('keluhan.store') }}"
                      method="POST">

                    @csrf

                    <div style="margin-bottom:12px;">

                        <label style="display:block;font-size:12px;font-weight:600;margin-bottom:4px;">
                            Pilih Kos
                        </label>

                        <select
                            name="kos_id"
                            style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;"
                            required>

                            @foreach ($kosList as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->nama_kos }} ({{ $k->lokasi }})
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:12px;">

                        <div>
                            <label style="display:block;font-size:12px;font-weight:600;margin-bottom:4px;">
                                Nomor Kamar
                            </label>

                            <input
                                type="text"
                                name="nomor_kamar"
                                placeholder="cth: 104"
                                style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;"
                                required>
                        </div>

                        <div>
                            <label style="display:block;font-size:12px;font-weight:600;margin-bottom:4px;">
                                Kategori
                            </label>

                            <select
                                name="type"
                                style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;">

                                <option value="keluhan">Fasilitas / AC</option>
                                <option value="perbaikan">Kelistrikan & Air</option>
                                <option value="chat">Pertanyaan Umum</option>

                            </select>
                        </div>

                    </div>


                    <div style="margin-bottom:12px;">

                        <label style="display:block;font-size:12px;font-weight:600;margin-bottom:4px;">
                            Judul Keluhan
                        </label>

                        <input
                            type="text"
                            name="subject"
                            placeholder="cth: AC Kamar Bocor"
                            style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;"
                            required>

                    </div>


                    <div style="margin-bottom:16px;">

                        <label style="display:block;font-size:12px;font-weight:600;margin-bottom:4px;">
                            Pesan / Detail Masalah
                        </label>

                        <textarea
                            name="body"
                            rows="3"
                            placeholder="Jelaskan kendala secara singkat..."
                            style="width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;font-family:inherit;"
                            required></textarea>

                    </div>


                    <div style="display:flex;justify-content:flex-end;gap:8px;">

                        <button type="button"
                                class="lp-btn lp-btn--ghost"
                                data-close>
                            Batal
                        </button>

                        <button type="submit"
                                class="lp-btn lp-btn--primary">
                            Kirim Keluhan
                        </button>

                    </div>

                </form>

            </div>
        </div>

    @endif


    {{-- =====================================================
         JAVASCRIPT MODAL DAN DETAIL KOS
    ====================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            'use strict';

            // Ambil data kos dari atribut HTML
            const kosDataElement = document.getElementById('lpKosData');

            let kosList = [];

            try {
                kosList = JSON.parse(
                    kosDataElement?.dataset.kos || '[]'
                );
            } catch (error) {
                console.error('Gagal membaca data kos:', error);
            }

            window.__KOS = kosList;


            // Status login pengguna
            const isLoggedIn = kosDataElement?.dataset.loggedIn === '1';

const isPenyewa = kosDataElement?.dataset.penyewa === '1';


            // Ambil modal
            const loginModal = document.getElementById('lpLoginModal');
            const detailModal = document.getElementById('lpDetailModal');
            const complaintModal = document.getElementById('lpComplaintModal');


            // Fungsi membuka modal
            function openModal(modal) {

                if (!modal) return;

                modal.hidden = false;
                document.body.style.overflow = 'hidden';

            }


            // Fungsi menutup modal
            function closeModal(modal) {

                if (!modal) return;

                modal.hidden = true;

                const openModals = document.querySelectorAll(
                    '.lp-modal:not([hidden])'
                );

                if (openModals.length === 0) {
                    document.body.style.overflow = '';
                }

            }


            // Semua tombol penutup modal
            document.querySelectorAll('.lp-modal [data-close]')
                .forEach(function (button) {

                    button.addEventListener('click', function () {

                        const modal = button.closest('.lp-modal');

                        closeModal(modal);

                    });

                });


            // Tutup modal dengan tombol Escape
            document.addEventListener('keydown', function (event) {

                if (event.key === 'Escape') {

                    document.querySelectorAll('.lp-modal:not([hidden])')
                        .forEach(closeModal);

                }

            });


            // Format harga
            function formatRupiah(value) {

                const harga = Number(value || 0);

                return 'Rp ' + new Intl.NumberFormat('id-ID')
                    .format(harga);

            }


            // Ambil elemen detail
            const detailTitle = document.getElementById('lpDetailTitle');
            const detailBadge = document.getElementById('lpDetailBadge');
            const detailAddr = document.getElementById('lpDetailAddr');
            const detailLokasi = document.getElementById('lpDetailLokasi');
            const detailKamar = document.getElementById('lpDetailKamar');
            const detailHarga = document.getElementById('lpDetailHarga');
            const detailFasilitas = document.getElementById('lpDetailFasilitas');
            const detailReserve = document.getElementById('lpDetailReserve');


            // Tombol detail kos
            document.querySelectorAll('[data-detail]')
                .forEach(function (button) {

                    button.addEventListener('click', function () {

                        const kosId = button.dataset.detail;

                        const kos = kosList.find(function (item) {
                            return String(item.id) === String(kosId);
                        });

                        if (!kos) {

                            console.error('Data kos tidak ditemukan:', kosId);

                            return;
                        }


                        // Isi informasi detail
                        detailTitle.textContent = kos.nama_kos || 'Nama kos tidak tersedia';

                        detailAddr.textContent = kos.alamat || 'Alamat belum tersedia';

                        detailLokasi.textContent = kos.lokasi || '-';

                        const jumlahKamar =
                            kos.total_kamar ??
                            kos.jumlah_kamar ??
                            kos.kamar ??
                            '-';

                        detailKamar.textContent = jumlahKamar;

                        detailHarga.textContent =
                            formatRupiah(kos.harga) + ' / Bulan';


                        // Status kos
                        const tersedia = kos.status === 'tersedia';

                        detailBadge.textContent = tersedia
                            ? 'Tersedia'
                            : 'Terbatas';

                        detailBadge.className = tersedia
                            ? 'lp-badge lp-badge--success'
                            : 'lp-badge lp-badge--warning';


                        // Fasilitas
                        detailFasilitas.replaceChildren();

                        const fasilitas = String(kos.fasilitas || '')
                            .split(',')
                            .map(function (item) {
                                return item.trim();
                            })
                            .filter(Boolean);

                        if (fasilitas.length === 0) {

                            const li = document.createElement('li');

                            li.textContent = 'Fasilitas belum tersedia';

                            detailFasilitas.appendChild(li);

                        } else {

                            fasilitas.forEach(function (item) {

                                const li = document.createElement('li');

                                li.textContent = item;

                                detailFasilitas.appendChild(li);

                            });

                        }


                        // Simpan ID kos untuk proses reservasi
                        detailReserve.dataset.kosId = kos.id;

                        // Buka modal detail
                        openModal(detailModal);

                    });

                });


            // Pemeriksaan login sebelum reservasi
            if (detailReserve) {

                detailReserve.addEventListener('click', function (event) {

                    if (!isLoggedIn || !isPenyewa) {

                        event.preventDefault();

                        closeModal(detailModal);

                        openModal(loginModal);

                    }

                    // Untuk penyewa yang sudah login,
                    // proses reservasi tetap mengikuti integrasi
                    // route dan JavaScript reservasi proyek.

                });

            }


            // Tombol chat dan keluhan
            const openComplaintButton =
                document.getElementById('lpOpenComplaint');

            if (openComplaintButton && complaintModal) {

                openComplaintButton.addEventListener('click', function () {

                    openModal(complaintModal);

                });

            }


            // Pastikan modal tidak terbuka ketika halaman pertama dimuat
            document.querySelectorAll('.lp-modal').forEach(function (modal) {

                modal.hidden = true;

            });

        });
    </script>

@endcomponent
