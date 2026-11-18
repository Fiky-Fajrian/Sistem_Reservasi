<x-layouts.landing :minimal="true" title="Masuk — KosKu" :hide-footer="true">
    <main class="lp-auth">
        <div class="lp-container">
            <div class="lp-auth-card">
                <span class="lp-auth-icon" aria-hidden="true">🔑</span>
                <h1>Selamat datang kembali!</h1>
                <p class="lp-auth-sub">Masuk untuk mencari kos dan melakukan reservasi.</p>

                @if ($errors->any())
                    <div class="lp-alert lp-alert--error" role="alert">
                        <strong>Ups, gagal masuk.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.attempt') }}" class="lp-form" novalidate>
                    @csrf
                    <div class="lp-form-field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="contoh: budi@gmail.com"
                               value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    <div class="lp-form-field">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="Password kamu"
                               required autocomplete="current-password">
                    </div>
                    <label class="lp-check">
                        <input type="checkbox" name="remember" value="1">
                        <span>Ingat saya di perangkat ini</span>
                    </label>
                    <button type="submit" class="lp-btn lp-btn--primary lp-btn--block">Masuk</button>
                </form>

                <p class="lp-auth-swap">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
            </div>

            <p class="lp-auth-lock">
                🔒 Reservasi kos di KosKu hanya bisa dilakukan oleh akun <strong>Penyewa</strong> yang sudah login.
            </p>
        </div>
    </main>
</x-layouts.landing>
