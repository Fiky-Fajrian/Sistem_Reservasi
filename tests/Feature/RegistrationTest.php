<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_penyewa_dapat_mendaftar_dengan_email_biasa(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'role' => 'penyewa',
        ]);

        $response->assertRedirect(route('landing'));
        $this->assertAuthenticated();

        $user = User::whereEmail('budi@gmail.com')->sole();
        $this->assertSame('penyewa', $user->role);
    }

    public function test_pemilik_kos_dengan_format_email_yang_benar_diterima(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Sinta Pemilik',
            'email' => 'sinta.pemilik@pemilik.kosku.id',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'role' => 'pemilik',
        ]);

        $response->assertRedirect(route('landing'));

        $user = User::whereEmail('sinta.pemilik@pemilik.kosku.id')->sole();
        $this->assertSame('pemilik', $user->role);
    }

    public function test_pemilik_kos_dengan_email_biasa_ditolak_lalu_diminta_hubungi_super_admin(): void
    {
        $response = $this->from(route('register'))->post(route('register.store'), [
            'name' => 'Sinta Pemilik',
            'email' => 'sinta@gmail.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'role' => 'pemilik',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors(['email']);

        $this->assertSame(0, User::where('role', 'pemilik')->count());

        $this->assertDatabaseMissing('users', ['email' => 'sinta@gmail.com']);
    }

    public function test_role_diluar_daftar_ditolak(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Hacker',
            'email' => 'hacker@gmail.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'role' => 'super_admin',
        ]);

        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['email' => 'hacker@gmail.com']);
    }

    public function test_halaman_daftar_menampilkan_pilihan_dan_ketentuan_role(): void
    {
        $response = $this->get(route('register'));

        $response->assertOk();
        $response->assertSee('Penyewa');
        $response->assertSee('Pemilik Kos');
        $response->assertSee('tidak bisa diganti');
        $response->assertSee('pemilik.kosku.id');
        $response->assertSee(config('kosku.superadmin_email'));
    }
}
