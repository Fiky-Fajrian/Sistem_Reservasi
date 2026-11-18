<?php

namespace Database\Factories;

use App\Models\Kos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kos>
 */
class KosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kos' => 'Kos '.fake()->unique()->company(),
            'alamat' => fake()->streetAddress(),
            'lokasi' => 'Jember',
            'harga' => fake()->randomFloat(2, 400000, 1500000),
            'fasilitas' => 'WiFi, Parkir, Dapur',
            'jumlah_kamar' => fake()->numberBetween(3, 12),
            'status' => 'tersedia',
        ];
    }
}
