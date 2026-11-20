<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PemilikFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_pemilik_kos_mendaftar_langsung_masuk_ke_dashboard(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Juragan Kos',
            'email' => 'juragan@pemilik.kosku.id',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => User::ROLE_PEMILIK,
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Dashboard Overview');
    }

    public function test_pemilik_bisa_berpindah_dari_meteran_ke_semua_menu_sidebar(): void
    {
        $pemilik = User::factory()->create([
            'role' => User::ROLE_PEMILIK,
            'email' => 'pemilik@pemilik.kosku.id',
        ]);

        $response = $this->actingAs($pemilik)->get(route('meteran.index'));
        $response->assertOk();

        // Pastikan link navigasi di sidebar meteran terhubung dan tidak ada href="#" untuk menu utama
        $response->assertSee(route('dashboard'));
        $response->assertSee(route('penghuni.index'));
        $response->assertSee(route('properti.index'));
        $response->assertSee(route('kamar.index'));
        $response->assertSee(route('tagihan.index'));
        $response->assertSee(route('meteran.index'));

        // Cek halaman tujuan dapat diakses
        $this->actingAs($pemilik)->get(route('penghuni.index'))->assertOk();
        $this->actingAs($pemilik)->get(route('properti.index'))->assertOk();
        $this->actingAs($pemilik)->get(route('kamar.index'))->assertOk();
        $this->actingAs($pemilik)->get(route('dashboard'))->assertOk();
    }
}
