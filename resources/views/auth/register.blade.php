<x-layouts.landing :minimal="true" title="Daftar — KosKu" :hide-footer="true">
    <main class="lp-auth">
        <div class="lp-container">
            <div class="lp-auth-card lp-auth-card--wide">
                <span class="lp-auth-icon" aria-hidden="true">📝</span>
                <h1>Buat akun KosKu</h1>
                <p class="lp-auth-sub">Pilih role-mu. Role dipilih sekali dan <strong>tidak bisa diganti</strong> setelah akun dibuat.</p>

                @if ($errors->any())
                    <div class="lp-alert lp-alert--error" role="alert">
                        <strong>Ups, pendaftaran gagal.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" class="lp-form" id="lpRegisterForm" novalidate>
                    @csrf

                    {{-- Pilihan role --}}
                    <fieldset class="lp-roles">
                        <legend>Pilih role kamu</legend>
                        <div class="lp-role-grid">
                            @foreach ($roles as $role)
                                <label class="lp-role-card {{ old('role', $defaultRole) === $role['key'] ? 'is-active' : '' }}">
                                    <input type="radio" name="role" value="{{ $role['key'] }}"
                                           data-note="{{ $role['note'] }}"
                                           @checked(old('role', $defaultRole) === $role['key'])>
                                    <span class="lp-role-head">
                                        <span class="lp-role-icon" aria-hidden="true">{{ $role['key'] === 'pemilik' ? '🛠' : '🙋' }}</span>
                                        <strong>{{ $role['label'] }}</strong>
                                    </span>
                                    <span class="lp-role-desc">{{ $role['desc'] }}</span>
                                    <span class="lp-role-note">{{ $role['note'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>

                    {{-- Ketentuan hak akses khusus Pemilik Kos --}}
                    <div class="lp-notice" id="lpPemilikNotice" hidden>
                        <strong>🔐 Hak akses Pemilik Kos perlu persetujuan Super Admin</strong>
                        <p>
                            Format email sudah <strong>ditentukan sistem</strong>: pendaftaran Pemilik Kos hanya menerima
                            email resmi berdomain <code>@pemilik.kosku.id</code> yang dibuat oleh Super Admin.
                            Belum punya email ini? Kirim permohonan akses ke
                            <a href="mailto:{{ config('kosku.superadmin_email') }}">{{ config('kosku.superadmin_email') }}</a>.
                        </p>
                    </div>

                    <div class="lp-form-field">
                        <label for="name">Nama lengkap</label>
                        <input id="name" type="text" name="name" placeholder="cth: Budi Santoso"
                               value="{{ old('name') }}" required autocomplete="name">
                    </div>

                    <div class="lp-form-field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="cth: budi@gmail.com"
                               value="{{ old('email') }}" required autocomplete="email">
                        <small class="lp-form-hint" id="lpEmailHint">Gunakan email pribadimu yang aktif.</small>
                    </div>

                    <div class="lp-form-row">
                        <div class="lp-form-field">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" placeholder="Minimal 8 karakter"
                                   required autocomplete="new-password">
                        </div>
                        <div class="lp-form-field">
                            <label for="password_confirmation">Ulangi password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   placeholder="Ketik ulang password" required autocomplete="new-password">
                        </div>
                    </div>

                    <p class="lp-form-lock">
                        🔒 Role tertuang permanen: setelah daftar, kamu <strong>tidak dapat berganti role</strong> pada akun yang sama.
                    </p>

                    <button type="submit" class="lp-btn lp-btn--primary lp-btn--block">Daftar Sekarang</button>
                </form>

                <p class="lp-auth-swap">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="{{ asset('auth/authForm.js') }}"></script>
    @endpush
</x-layouts.landing>
