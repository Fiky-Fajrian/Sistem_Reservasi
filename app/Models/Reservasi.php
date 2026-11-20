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
        'nik',
        'nomor_hp',
        'alamat_penghuni',
        'status_penghuni',
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kos');
  }
}
