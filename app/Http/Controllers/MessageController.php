<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Kirim chat atau keluhan dari penyewa ke pengelola kos.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kos_id' => ['nullable', 'exists:kos,id'],
            'nomor_kamar' => ['nullable', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'type' => ['nullable', 'string', 'max:30'],
        ]);

        $senderId = Auth::id();
        if (! $senderId) {
            $sender = User::where('role', User::ROLE_PENYEWA)->first() ?? User::first();
            $senderId = $sender?->id;
        }

        $receiver = User::whereIn('role', [User::ROLE_SUPER_ADMIN, User::ROLE_PEMILIK])->first();

        Message::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiver?->id,
            'kos_id' => $validated['kos_id'] ?? null,
            'nomor_kamar' => $validated['nomor_kamar'] ?? null,
            'subject' => $validated['subject'],
            'body' => $validated['body'],
            'type' => $validated['type'] ?? 'keluhan',
            'status' => 'menunggu',
            'is_read' => false,
        ]);

        return back()->with('success', 'Keluhan / pesan Anda berhasil dikirim ke pengelola kos!');
    }

    /**
     * Pengelola memperbarui status atau membalas pesan.
     */
    public function update(Request $request, Message $message): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:menunggu,sedang_diperbaiki,selesai'],
            'reply' => ['nullable', 'string'],
        ]);

        $message->update([
            'status' => $validated['status'],
            'reply' => $validated['reply'] ?? $message->reply,
            'is_read' => true,
        ]);

        return back()->with('success', 'Status tiket/pesan berhasil diperbarui!');
    }
}
