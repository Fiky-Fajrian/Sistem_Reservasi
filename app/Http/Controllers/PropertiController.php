<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertiController extends Controller
{
    /**
     * Halaman Properti Saya — Manajemen Kamar & Ketersediaan Unit.
     */
    public function index(Request $request): View
    {
        $kosList = Kos::query()->orderBy('nama_kos')->get();
        $selectedKos = $kosList->first();

        // Data pesan & keluhan penyewa
        $messages = Message::with(['sender', 'kos'])->latest()->get();
        $activeTickets = $messages->where('status', '!=', 'selesai');

        return view('properti', [
            'kosList' => $kosList,
            'selectedKos' => $selectedKos,
            'messages' => $messages,
            'activeTickets' => $activeTickets,
        ]);
    }
}
