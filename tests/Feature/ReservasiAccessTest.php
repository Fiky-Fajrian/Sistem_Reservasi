<?php

namespace Tests\Feature;

use App\Models\Kos;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservasiAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_tamu_yang_membuka_reservasi_diarahkan_ke_login(): void
    {
        $response = $this->get(route('reservasi.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_penyewa_yang_login_dapat_membuka_dan_mengajukan_reservasi(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_PENYEWA]);
        $kos = Kos::factory()->create();

        $response = $this->actingAs($user)->get(route('reservasi.index'));
        $response->assertOk();
        $response->assertSee($kos->nama_kos);

        $response = $this->actingAs($user)->post(route('reservasi.store'), [
            'id_kos' => $kos->id,
            'nomor_kamar' => 'A-01',
            'tanggal_mulai' => now()->toDateString(),
            'durasi_bulan' => 3,
        ]);

        $response->assertRedirect(route('reservasi.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('reservasi', [
            'nama_penyewa' => $user->name,
            'id_kos' => $kos->id,
            'nomor_kamar' => 'A-01',
        ]);
    }

    public function test_pemilik_kos_ditolak_mengakses_reservasi(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_PEMILIK]);

        $response = $this->actingAs($user)->get(route('reservasi.index'));

        $response->assertRedirect(route('landing'));
        $response->assertSessionHas('warning');
    }
}
