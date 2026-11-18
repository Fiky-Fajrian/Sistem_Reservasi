<?php

namespace Database\Seeders;

use App\Models\Kos;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $penyewa = User::where('role', 'penyewa')->first() ?? User::first();
        $admin = User::where('role', 'super_admin')->first();
        $kos = Kos::first();

        if ($penyewa) {
            Message::updateOrCreate(
                ['subject' => 'AC Bocor dan Mengeluarkan Air'],
                [
                    'sender_id' => $penyewa->id,
                    'receiver_id' => $admin?->id,
                    'kos_id' => $kos?->id,
                    'nomor_kamar' => '104',
                    'subject' => 'AC Bocor dan Mengeluarkan Air',
                    'body' => 'AC di kamar 104 tiba-tiba meneteskan air cukup deras di atas meja belajar. Mohon bantuan teknisi untuk segera memperbaiki.',
                    'type' => 'keluhan',
                    'status' => 'sedang_diperbaiki',
                    'reply' => 'Teknisi Budi dijadwalkan datang hari ini pukul 16:00 WIB untuk perbaikan dan pembersihan AC.',
                    'is_read' => true,
                ]
            );
        }
    }
}
