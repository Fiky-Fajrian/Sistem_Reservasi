<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'KosKu — Temukan Kos Impianmu dengan Mudah' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('landing_page/landingPage.css') }}">
</head>
<body class="lp-body"
      data-auth="{{ auth()->check() ? 'true' : 'false' }}"
      data-role="{{ auth()->user()->role ?? '' }}">

    {{-- ===== Header ===== --}}
    @php
        $user = auth()->user();
        $roleLabels = [
            \App\Models\User::ROLE_PENYEWA   => 'Penyewa',
            \App\Models\User::ROLE_PEMILIK   => 'Pemilik Kos',
            \App\Models\User::ROLE_SUPER_ADMIN => 'Super Admin',
        ];
    @endphp

    <header class="lp-header" id="lpHeader">
        <div class="lp-container lp-header-inner">
            <a href="{{ route('landing') }}" class="lp-brand" aria-label="KosKu — ke beranda">
                <span class="lp-brand-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M10 21v-6h4v6"/></svg>
                </span>
                <span class="lp-brand-text">KosKu<small>Solusi Hunian Nyaman</small></span>
            </a>

            @unless ($minimal ?? false)
                <nav class="lp-nav" aria-label="Navigasi utama">
                    <a href="{{ route('landing') }}" class="lp-nav-link {{ url()->current() === route('landing') ? 'is-active' : '' }}">Beranda</a>
                    <a href="{{ route('landing') }}#daftar-kos" class="lp-nav-link">Daftar Kos</a>
                    <a href="{{ route('landing') }}#tentang-kami" class="lp-nav-link">Tentang Kami</a>
                </nav>
            @endunless

            <div class="lp-header-actions">
                @guest
                    <a href="{{ route('login') }}" class="lp-btn lp-btn--ghost">Login</a>
                    <a href="{{ route('register') }}" class="lp-btn lp-btn--primary">Daftar</a>
                @else
                    <div class="lp-userchip">
                        <span class="lp-avatar">{{ strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                        <span class="lp-userchip-info"><strong>{{ $user->name }}</strong><small>{{ $roleLabels[$user->role] ?? $user->role }}</small></span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="lp-inline-form">
                        @csrf
                        <button type="submit" class="lp-btn lp-btn--ghost">Log out</button>
                    </form>
                @endguest
                <button type="button" class="lp-burger" id="lpBurger" aria-label="Buka menu" aria-expanded="false">☰</button>
            </div>
        </div>
        <div class="lp-mobile-menu" id="lpMobileMenu" hidden>
            <a href="{{ route('landing') }}" class="lp-nav-link is-active">Beranda</a>
            <a href="{{ route('landing') }}#daftar-kos" class="lp-nav-link">Daftar Kos</a>
            <a href="{{ route('landing') }}#tentang-kami" class="lp-nav-link">Tentang Kami</a>
            @guest
                <a href="{{ route('login') }}" class="lp-btn lp-btn--ghost">Login</a>
                <a href="{{ route('register') }}" class="lp-btn lp-btn--primary">Daftar</a>
            @endguest
        </div>
    </header>

    {{ $slot }}

    @unless ($hideFooter ?? false)
        {{-- ===== Footer ===== --}}
        <footer class="lp-footer">
            <div class="lp-container lp-footer-grid">
                <div class="lp-footer-brand">
                    <a href="{{ route('landing') }}" class="lp-brand lp-brand--light">
                        <span class="lp-brand-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M10 21v-6h4v6"/></svg>
                        </span>
                        <span class="lp-brand-text">KosKu<small>Solusi Hunian Nyaman</small></span>
                    </a>
                    <p>
                        Sistem Informasi Reservasi Kos berbasis web dengan manajemen role pengguna —
                        dibuat agar pencari kos dan pemilik kos terhubung dengan mudah.
                    </p>
                </div>

                <div class="lp-footer-col">
                    <h4>NAVIGASI</h4>
                    <a href="{{ route('landing') }}">Beranda</a>
                    <a href="{{ route('landing') }}#daftar-kos">Daftar Kos</a>
                    <a href="{{ route('landing') }}#tentang-kami">Tentang Kami</a>
                    @guest
                        <a href="{{ route('login') }}">Masuk Akun</a>
                        <a href="{{ route('register') }}">Daftar Akun</a>
                    @else
                        <a href="{{ route('reservasi.index') }}">Reservasi</a>
                        <form method="POST" action="{{ route('logout') }}" class="lp-inline-form lp-inline-form--footer">
                            @csrf
                            <button type="submit">Log out</button>
                        </form>
                    @endguest
                </div>

                <div class="lp-footer-col">
                    <h4>HUBUNGI KAMI</h4>
                    <a href="#" class="lp-footer-contact">📍 Jember, Jawa Timur</a>
                    <a href="mailto:bantuan@kosku.id" class="lp-footer-contact">✉ hello@kosku.id</a>
                    <a href="tel:+6281234567890" class="lp-footer-contact">📞 +62 812-3456-7890</a>
                </div>
            </div>
            <div class="lp-container lp-footer-bottom">
                <span>© {{ date('Y') }} KosKu. Seluruh hak cipta dilindungi.</span>
                <span class="lp-footer-links">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                </span>
            </div>
        </footer>
    @endunless

    @if (session('success'))
        <div class="lp-toast lp-toast--success" data-toast>{{ session('success') }}</div>
    @endif
    @if (session('warning'))
        <div class="lp-toast lp-toast--warning" data-toast>{{ session('warning') }}</div>
    @endif
    @if (session('error'))
        <div class="lp-toast lp-toast--error" data-toast>{{ session('error') }}</div>
    @endif

    <script src="{{ asset('landing_page/landingPage.js') }}"></script>
    @stack('scripts')
</body>
</html>
