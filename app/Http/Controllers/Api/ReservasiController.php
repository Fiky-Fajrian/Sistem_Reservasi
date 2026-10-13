<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReservasiController extends Controller
{
        public function update(Request $request, $id): JsonResponse
    {
        $reservasi = Reservasi::find($id);

        if (!$reservasi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data reservasi tidak ditemukan'
            ], 404);
        }

        $data = $request->validate([
            'nama_penyewa' => 'required|string',
            'id_kos' => 'required|exists:kos,id',
            'nomor_kamar' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'durasi_bulan' => 'required|integer|min:1',
        ]);

        $reservasi->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Reservasi berhasil diperbarui',
            'data' => $reservasi
        ]);
    }
}
    