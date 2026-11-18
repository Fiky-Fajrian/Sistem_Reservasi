<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengguna_dapat_login_dengan_kredensial_benar(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('rahasia123'),
        ]);

        $response = $this->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'rahasia123',
        ]);

        $response->assertRedirect(route('landing'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_dengan_password_salah_gagal(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('rahasia123'),
        ]);

        $response = $this->from(route('login'))->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'password-salah',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_pengguna_login_dapat_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('landing'));
        $this->assertGuest();
    }

    public function test_halaman_login_tidak_untuk_pengguna_yang_sudah_login(): void
    {
        $penyewa = User::factory()->create(['role' => User::ROLE_PENYEWA]);
        $this->actingAs($penyewa)->get(route('login'))->assertRedirect(route('landing'));

        $pemilik = User::factory()->create(['role' => User::ROLE_PEMILIK]);
        $this->actingAs($pemilik)->get(route('login'))->assertRedirect(route('dashboard'));
    }
}
