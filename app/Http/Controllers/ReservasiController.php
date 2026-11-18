<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class ReservasiController extends Controller
{
    /**
     * Tampilkan halaman reservasi (khusus penyewa yang login).
     */
    public function index(Request $request): View
    {
        return view('reservasi.index', [
            'kosList' => Kos::query()->orderBy('nama_kos')->get(),
            'preselectedKosId' => $request->query('kos'),
            'reservasiList' => Reservasi::query()
                ->with('kos')
                ->where('nama_penyewa', $request->user()->name)
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Simpan reservasi baru milik penyewa yang sedang login.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kos' => ['required', 'exists:kos,id'],
            'nomor_kamar' => ['required', 'string', 'max:255'],
            'tanggal_mulai' => ['required', 'date', 'after_or_equal:today'],
            'durasi_bulan' => ['required', 'integer', 'min:1', 'max:24'],
        ]);

        $kos = Kos::findOrFail($data['id_kos']);

        $reservasi = Reservasi::create([
            'nama_penyewa' => $request->user()->name,
            'id_kos' => $kos->id,
            'nomor_kamar' => $data['nomor_kamar'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'durasi_bulan' => $data['durasi_bulan'],
        ]);

        return redirect()
            ->route('reservasi.index')
            ->with('success', sprintf(
                'Reservasi %s kamar %s berhasil dibuat untuk %d bulan mulai %s.',
                $kos->nama_kos,
                $reservasi->nomor_kamar,
                $reservasi->durasi_bulan,
                Carbon::parse($reservasi->tanggal_mulai)->translatedFormat('d F Y'),
            ));
    }
}
