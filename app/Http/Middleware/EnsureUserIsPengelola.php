<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsPengelola
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->guest(route('login'));
        }

        if (!in_array($user->role, [
            User::ROLE_PEMILIK,
            User::ROLE_SUPER_ADMIN,
        ], true)) {
            return redirect()
                ->route('landing')
                ->with('warning', 'Halaman ini hanya dapat diakses pengelola kos.');
        }

        return $next($request);
    }
}
