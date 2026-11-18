/* ============================================================
   KosKu — Form Pendaftaran
   - Pemilihan role aktif (Penyewa / Pemilik Kos)
   - Menyesuaikan petunjuk format email sesuai role
   ============================================================ */

(function () {
    'use strict';

    const qsa = (sel, root) => Array.from((root || document).querySelectorAll(sel));

    const form = document.getElementById('lpRegisterForm');
    if (!form) return;

    const cards = qsa('.lp-role-card', form);
    const radios = qsa('input[name="role"]', form);
    const notice = document.getElementById('lpPemilikNotice');
    const emailHint = document.getElementById('lpEmailHint');
    const emailInput = document.getElementById('email');

    const HINTS = {
        penyewa: 'Gunakan email pribadimu yang aktif (cth: budi@gmail.com).',
        pemilik: 'Wajib email resmi dari Super Admin (cth: budi@pemilik.kosku.id).',
    };

    const PLACEHOLDERS = {
        penyewa: 'cth: budi@gmail.com',
        pemilik: 'cth: budi@pemilik.kosku.id',
    };

    function applyRole() {
        let active = 'penyewa';

        cards.forEach((card) => {
            const radio = card.querySelector('input[name="role"]');
            const isActive = radio && radio.checked;
            card.classList.toggle('is-active', Boolean(isActive));
            if (isActive) active = radio.value;
        });

        if (notice) notice.hidden = active !== 'pemilik';
        if (emailHint) emailHint.textContent = HINTS[active] || HINTS.penyewa;
        if (emailInput) emailInput.placeholder = PLACEHOLDERS[active] || PLACEHOLDERS.penyewa;
    }

    radios.forEach((radio) => radio.addEventListener('change', applyRole));
    applyRole();

    /* Konfirmasi password: cocokkan saat submit (interaksi ringan) */
    form.addEventListener('submit', () => applyRole());
})();
