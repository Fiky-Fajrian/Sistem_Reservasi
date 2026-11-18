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

    /**
     * Data reservasi menggunakan nama penyewa (string), namun
     * tetap terhubung ke data kos yang dipesan.
     */
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }
}
