<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';

    protected $fillable = [
        'nama_penyewa',
        'id_kos',
        'nomor_kamar',
        'tanggal_mulai',
        'durasi_bulan',
    ];
}