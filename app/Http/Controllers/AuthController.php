<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\PemilikEmailDomain;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->redirectToTarget($request)
                ->with('success', 'Selamat datang kembali, '.Auth::user()->name.'!');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('landing')
            ->with('success', 'Kamu berhasil keluar. Sampai jumpa!');
    }

    /**
     * Tampilkan halaman pendaftaran dengan pilihan role.
     */
    public function showRegister(): View
    {
        $roles = [
            [
                'key' => User::ROLE_PENYEWA,
                'label' => 'Penyewa',
                'desc' => 'Cari dan reservasi kos favoritmu.',
                'note' => 'Aktivasi langsung, gunakan email pribadimu.',
            ],
            [
                'key' => User::ROLE_PEMILIK,
                'label' => 'Pemilik Kos',
                'desc' => 'Kelola kos dan daftar kamar milikmu.',
                'note' => 'Butuh akses dari Super Admin.',
            ],
        ];

        return view('auth.register', [
            'roles' => $roles,
            'defaultRole' => $this->defaultRole(),
        ]);
    }

    /**
     * Role yang dipilih saat pendaftaran. Sifatnya permanen
     * dan tidak dapat diganti setelah akun dibuat.
     */
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class),
                // Hak akses Pemilik Kos memerlukan email resmi dari Super Admin
                // dengan format yang sudah ditentukan.
                Rule::when(
                    $request->input('role') === User::ROLE_PEMILIK,
                    [new PemilikEmailDomain],
                ),
            ],
            'password' => ['required', 'string', Password::min(8), 'confirmed'],
            'role' => ['required', 'in:'.User::ROLE_PENYEWA.','.User::ROLE_PEMILIK],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        $message = $data['role'] === User::ROLE_PEMILIK
            ? 'Pendaftaran Pemilik Kos berhasil. Role-mu permanen dan tidak dapat diganti.'
            : 'Selamat datang di KosKu, '.$user->name.'! Role-mu sudah tetap sebagai Penyewa.';

        return $this->redirectToTarget($request)->with('success', $message);
    }

    /**
     * Arahkan kembali ke tujuan setelah login/daftar: menghormati parameter
     * ?redirect= dari tombol terkunci (hanya path internal) atau session intended.
     */
    private function redirectToTarget(Request $request): RedirectResponse
    {
        $redirect = (string) $request->query('redirect');

        if ($redirect !== '' && str_starts_with($redirect, '/') && ! str_starts_with($redirect, '//')) {
            return redirect()->to($redirect);
        }

        return redirect()->intended(route('landing'));
    }

    /**
     * Pengguna baru default-nya penyewa bila role tidak dipilih.
     */
    private function defaultRole(): string
    {
        return User::ROLE_PENYEWA;
    }
}
