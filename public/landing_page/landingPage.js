/* ============================================================
   KosKu — Landing Page Interactions
   Fitur:
   1. Tombol reservasi wajib login (modal pengingat untuk tamu)
   2. Modal detail kos dari data server
   3. Filter/pencarian membaca parameter URL
   4. Toast notifikasi (dari flash session Laravel)
   ============================================================ */

(function () {
    'use strict';

    const body = document.body;
    const IS_AUTHED = body.dataset.auth === 'true';
    const USER_ROLE = body.dataset.role || '';
    const ROLES = { penyewa: 'Penyewa', pemilik: 'Pemilik Kos', super_admin: 'Super Admin' };

    /* ---------- Helpers ---------- */
    const qs = (sel, root) => (root || document).querySelector(sel);
    const qsa = (sel, root) => Array.from((root || document).querySelectorAll(sel));

    function openModal(modal) {
        if (!modal) return;
        modal.hidden = false;
        body.style.overflow = 'hidden';
        const focusTarget = qs('a,button,input,select', modal.querySelector('.lp-modal-panel'));
        if (focusTarget) focusTarget.focus();
    }

    function closeModal(modal) {
        if (!modal || modal.hidden) return;
        modal.hidden = true;
        body.style.overflow = '';
    }

    qsa('.lp-modal').forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target.hasAttribute('data-close')) closeModal(modal);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') qsa('.lp-modal').forEach(closeModal);
    });

    function toast(message, kind) {
        const el = document.createElement('div');
        el.className = 'lp-toast' + (kind ? ' lp-toast--' + kind : '');
        el.textContent = message;
        document.body.appendChild(el);
        removeToastLater(el);
    }

    function removeToastLater(el) {
        setTimeout(() => {
            el.classList.add('lp-toast--out');
            setTimeout(() => el.remove(), 260);
        }, 5200);
    }

    qsa('[data-toast]').forEach(removeToastLater);

    /* ---------- Header ---------- */
    const header = qs('#lpHeader');
    if (header) {
        const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 8);
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    const burger = qs('#lpBurger');
    const mobileMenu = qs('#lpMobileMenu');
    if (burger && mobileMenu) {
        burger.addEventListener('click', () => {
            const open = mobileMenu.hidden;
            mobileMenu.hidden = !open;
            burger.setAttribute('aria-expanded', String(open));
        });
        qsa('a', mobileMenu).forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.hidden = true;
                burger.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* ---------- Gate: reservasi wajib login ---------- */
    const LOGIN_HREF = (() => {
        const cta = qs('#lpLoginModalLogin');
        return cta ? cta.getAttribute('href') : '/login';
    })();

    function loginUrlWithRedirect(redirectTo) {
        if (!redirectTo) return LOGIN_HREF;
        return LOGIN_HREF + (LOGIN_HREF.includes('?') ? '&' : '?') + 'redirect=' + encodeURIComponent(redirectTo);
    }

    qsa('[data-gate]').forEach((element) => {
        element.addEventListener('click', (event) => {
            if (IS_AUTHED) {
                // Sudah login: role dicek juga di sisi server (middleware).
                if (USER_ROLE && ROLES[USER_ROLE] && USER_ROLE !== 'penyewa') {
                    event.preventDefault();
                    toast('Reservasi hanya untuk role Penyewa. Akunmu (' + ROLES[USER_ROLE] + ') tidak dapat memesan kamar.', 'warning');
                }
                return; // Lanjut navigasi normal
            }

            event.preventDefault();

            const target = element.getAttribute('href');
            const landingUrlHref = new URL(window.location.href);
            landingUrlHref.hash = 'beranda';
            const redirectTo = target
                ? (target.startsWith('#') ? landingUrlHref.pathname + target : target)
                : window.location.pathname;

            // Tutup modal lain agar kartu login tampil penuh di depan,
            // tidak tertutup kartu detail kos.
            qsa('.lp-modal').forEach(closeModal);

            const loginModal = qs('#lpLoginModal');
            const loginCta = qs('#lpLoginModalLogin');
            if (loginCta) loginCta.setAttribute('href', loginUrlWithRedirect(redirectTo));
            openModal(loginModal);
        });
    });

    /* ---------- Modal detail kos ---------- */
    const KOS_DATA = Array.isArray(window.__KOS) ? window.__KOS : [];
    const detailModal = qs('#lpDetailModal');

    function rupiah(value) {
        return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
    }

    function openDetail(id) {
        const kos = KOS_DATA.find((item) => String(item.id) === String(id));
        if (!kos) return;

        const setText = (selector, text) => { const el = qs(selector); if (el) el.textContent = text; };
        setValue('lpDetailTitle', kos.nama_kos);
        setBadge(kos.status, kos.jumlah_kamar);
        setText('#lpDetailAddr', kos.alamat);
        setText('#lpDetailLokasi', kos.lokasi);
        setText('#lpDetailKamar', kos.jumlah_kamar + ' kamar');
        setText('#lpDetailHarga', rupiah(kos.harga) + ' /bulan');

        const media = qs('#lpDetailMedia');
        if (media) {
            media.className = 'lp-detail-media lp-media-' + ((KOS_DATA.indexOf(kos) % 3) + 1);
            media.innerHTML = '';
        }

        const chips = qs('#lpDetailFasilitas');
        if (chips) {
            chips.innerHTML = '';
            String(kos.fasilitas || '').split(',').map((f) => f.trim()).filter(Boolean).forEach((fasilitas) => {
                const li = document.createElement('li');
                li.textContent = fasilitas;
                chips.appendChild(li);
            });
        }

        const reserve = qs('#lpDetailReserve');
        if (reserve) {
            reserve.setAttribute('href', '/reservasi?kos=' + encodeURIComponent(kos.id));
        }

        openModal(detailModal);
    }

    function setValue(id, value) {
        const el = document.getElementById(id);
        if (el) el.textContent = value;
    }

    function setBadge(status, jumlahKamar) {
        const badge = qs('#lpDetailBadge');
        if (!badge) return;
        badge.classList.remove('lp-badge--success', 'lp-badge--warning');
        if (status === 'tersedia') {
            badge.classList.add('lp-badge--success');
            badge.textContent = 'Tersedia';
        } else {
            badge.classList.add('lp-badge--warning');
            badge.textContent = 'Terbatas (' + jumlahKamar + ' kamar)';
        }
    }

    qsa('[data-detail]').forEach((button) => {
        button.addEventListener('click', () => openDetail(button.getAttribute('data-detail')));
    });

    /* ---------- Pencarian ---------- */
    const searchForm = qs('.lp-search');
    if (searchForm) {
        qsa('select, input', searchForm).forEach((field) => {
            field.addEventListener('change', () => searchForm.requestSubmit ? searchForm.requestSubmit() : searchForm.submit());
        });
    }
})();
