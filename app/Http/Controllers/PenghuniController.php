<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Kos;

class PenghuniController extends Controller
{
    // Menampilkan data penghuni
    public function index()
    {
        $penghuni = Reservasi::with('kos')
            ->orderByDesc('id')
            ->get();

        $kosList = Kos::all();

        return view('penghuni.index', compact('penghuni', 'kosList'));
    }

    // Menambahkan penghuni
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_penyewa' => 'required|string|max:255',
            'id_kos' => 'required|exists:kos,id',
            'nomor_kamar' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'durasi_bulan' => 'required|integer|min:1',
            'nik' => 'nullable|string|max:16',
            'nomor_hp' => 'nullable|string|max:20',
            'alamat_penghuni' => 'nullable|string',
            'status_penghuni' => 'nullable|string|max:50',
        ]);

        $validated['status_penghuni'] =
            $validated['status_penghuni'] ?? 'Aktif';

        Reservasi::create($validated);

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil ditambahkan.');
    }

    // Mengedit data penghuni
    public function update(Request $request, $id)
    {
        $penghuni = Reservasi::findOrFail($id);

        $validated = $request->validate([
            'nama_penyewa' => 'required|string|max:255',
            'id_kos' => 'required|exists:kos,id',
            'nomor_kamar' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'durasi_bulan' => 'required|integer|min:1',
            'nik' => 'nullable|string|max:16',
            'nomor_hp' => 'nullable|string|max:20',
            'alamat_penghuni' => 'nullable|string',
            'status_penghuni' => 'nullable|string|max:50',
        ]);

        $penghuni->update($validated);

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil diperbarui.');
    }

    // Menghapus data penghuni
    public function destroy($id)
    {
        $penghuni = Reservasi::findOrFail($id);
        $penghuni->delete();

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil dihapus.');
    }
}
