<?php

namespace Database\Seeders;

use App\Models\Kos;
use Illuminate\Database\Seeder;

class KosSeeder extends Seeder
{
    /**
     * Data awal kos untuk tampilan "Kos Populer".
     *
     * @return array<int, array<string, mixed>>
     */
    private function data(): array
    {
        return [
            [
                'nama_kos' => 'Kos Melati',
                'alamat' => 'Jl. Melati No. 12, Sumbersari',
                'lokasi' => 'Jember',
                'harga' => 750000,
                'fasilitas' => 'WiFi, Parkir, Dapur, Kamar Mandi Dalam',
                'jumlah_kamar' => 8,
                'status' => 'tersedia',
            ],
            [
                'nama_kos' => 'Kos Mawar',
                'alamat' => 'Jl. Kenanga No. 5, Wuluhan',
                'lokasi' => 'Jember',
                'harga' => 600000,
                'fasilitas' => 'WiFi, Parkir, Laundry, Kamar Mandi Dalam',
                'jumlah_kamar' => 4,
                'status' => 'terbatas',
            ],
            [
                'nama_kos' => 'Kos Anggrek',
                'alamat' => 'Jl. Merdeka No. 88, Tegalboto',
                'lokasi' => 'Jember',
                'harga' => 600000,
                'fasilitas' => 'WiFi, Dapur, Dispenser, Parkir',
                'jumlah_kamar' => 6,
                'status' => 'tersedia',
            ],
            [
                'nama_kos' => 'Kos Dahlia',
                'alamat' => 'Jl. Dahlia No. 21, Blimbing',
                'lokasi' => 'Malang',
                'harga' => 950000,
                'fasilitas' => 'AC, WiFi, Laundry, Dapur',
                'jumlah_kamar' => 10,
                'status' => 'tersedia',
            ],
            [
                'nama_kos' => 'Kos Sakura',
                'alamat' => 'Jl. Sakura No. 3, Lowokwaru',
                'lokasi' => 'Malang',
                'harga' => 1200000,
                'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam, Meja Belajar',
                'jumlah_kamar' => 5,
                'status' => 'tersedia',
            ],
            [
                'nama_kos' => 'Kos Kenanga',
                'alamat' => 'Jl. Kenanga No. 40, Kartasura',
                'lokasi' => 'Sukoharjo',
                'harga' => 500000,
                'fasilitas' => 'WiFi, Parkir, Dispenser',
                'jumlah_kamar' => 3,
                'status' => 'terbatas',
            ],
        ];
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->data() as $kos) {
            Kos::updateOrCreate(
                ['nama_kos' => $kos['nama_kos']],
                $kos,
            );
        }
    }
}
