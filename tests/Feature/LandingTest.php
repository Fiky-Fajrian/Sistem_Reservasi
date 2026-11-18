<?php

namespace Tests\Feature;

use App\Models\Kos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_landing_ditampilkan_dengan_daftar_kos(): void
    {
        Kos::factory()->create(['nama_kos' => 'Kos Melati', 'lokasi' => 'Jember']);

        $response = $this->get(route('landing'));

        $response->assertOk();
        $response->assertSee('Kos Melati');
        $response->assertSee('Kos Populer');
    }

    public function test_pencarian_filter_nama_kos(): void
    {
        Kos::factory()->create(['nama_kos' => 'Kos Melati']);
        Kos::factory()->create(['nama_kos' => 'Kos Mawar']);

        $response = $this->get(route('landing', ['q' => 'Melati']));

        $response->assertOk();
        $response->assertSee('Kos Melati');
        $response->assertDontSee('Kos Mawar');
    }

    public function test_filter_lokasi_dan_harga(): void
    {
        Kos::factory()->create(['nama_kos' => 'Kos Murah Jember', 'harga' => 500000, 'lokasi' => 'Jember']);
        Kos::factory()->create(['nama_kos' => 'Kos Mahal Malang', 'harga' => 1500000, 'lokasi' => 'Malang']);

        $response = $this->get(route('landing', ['lokasi' => 'Jember']));
        $response->assertSee('Kos Murah Jember')->assertDontSee('Kos Mahal Malang');

        $response = $this->get(route('landing', ['harga' => '1000-999999']));
        $response->assertSee('Kos Mahal Malang')->assertDontSee('Kos Murah Jember');
    }

    public function test_tampilkan_pesan_ketika_hasil_kosong(): void
    {
        $response = $this->get(route('landing', ['q' => 'bukan-nama-kos']));

        $response->assertOk();
        $response->assertSee('Tidak ada kos yang cocok');
    }
}
