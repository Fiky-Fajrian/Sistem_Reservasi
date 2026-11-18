<?php

namespace Tests\Feature;

use App\Models\Kos;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertiAndKeluhanTest extends TestCase
{
    use RefreshDatabase;

    public function test_properti_page_renders_successfully(): void
    {
        $response = $this->get(route('properti.index'));

        $response->assertStatus(200);
        $response->assertSee('25 UNIT TOTAL');
        $response->assertSee('Kamar 103');
        $response->assertSee('Sayap Samudra');
    }

    public function test_penyewa_can_submit_complaint(): void
    {
        $user = User::factory()->create(['role' => 'penyewa']);
        $kos = Kos::create([
            'nama_kos' => 'Kos Melati',
            'alamat' => 'Jl. Melati No. 12',
            'lokasi' => 'Jember',
            'harga' => 750000,
            'jumlah_kamar' => 8,
            'status' => 'tersedia',
        ]);

        $response = $this->actingAs($user)->post(route('keluhan.store'), [
            'kos_id' => $kos->id,
            'nomor_kamar' => '104',
            'subject' => 'AC Kamar Bocor',
            'body' => 'Air AC menetes deras ke lantai',
            'type' => 'keluhan',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('messages', [
            'subject' => 'AC Kamar Bocor',
            'nomor_kamar' => '104',
        ]);
    }

    public function test_owner_can_update_complaint_status(): void
    {
        $user = User::factory()->create();
        $message = Message::create([
            'sender_id' => $user->id,
            'subject' => 'Lampu Mati',
            'body' => 'Lampu balkon mati',
            'status' => 'menunggu',
        ]);

        $response = $this->actingAs($user)->put(route('keluhan.update', $message->id), [
            'status' => 'sedang_diperbaiki',
            'reply' => 'Teknisi sudah dihubungi',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'status' => 'sedang_diperbaiki',
            'reply' => 'Teknisi sudah dihubungi',
        ]);
    }
}
