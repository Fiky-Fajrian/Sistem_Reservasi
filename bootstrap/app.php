<?php

use App\Http\Middleware\EnsureUserIsPenyewa;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
        'role.penyewa' => EnsureUserIsPenyewa::class,
        'role.pengelola' => \App\Http\Middleware\EnsureUserIsPengelola::class,
    ]);

        // Pengguna yang sudah login dan membuka halaman tamu (login/daftar)
        // diarahkan sesuai role-nya.
        $middleware->redirectUsersTo(fn (Request $request): string => $request->user()?->role === User::ROLE_PENYEWA
            ? route('landing')
            : route('dashboard'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
