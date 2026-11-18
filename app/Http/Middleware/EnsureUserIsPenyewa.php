<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsPenyewa
{
    /**
     * Fitur reservasi hanya untuk role penyewa.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null) {
            return redirect()->guest(route('login'));
        }

        if ($user->role !== User::ROLE_PENYEWA) {
            return redirect()
                ->route('landing')
                ->with('warning', 'Reservasi hanya dapat dilakukan oleh penyewa.');
        }

        return $next($request);
    }
}
