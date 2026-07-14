<?php

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        api: __DIR__ . '/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Illuminate\Auth\Access\AuthorizationException $exception, \Illuminate\Http\Request $request) {
            $panel = \Filament\Facades\Filament::getCurrentPanel();
            if ($panel) {
                $user = auth()->user();
                if ($user) {
                    // Determine the correct panel for this user
                    $correctPanel = 'admin';
                    if ($user->hasAnyRole(['super_admin', 'admin'])) {
                        $correctPanel = 'admin';
                    } elseif ($user->hasRole('guru')) {
                        $correctPanel = 'guru';
                    } elseif ($user->hasRole('siswa')) {
                        $correctPanel = 'siswa';
                    } elseif ($user->hasRole('orang_tua')) {
                        $correctPanel = 'orang_tua';
                    }

                    // Log the user out from current session
                    auth()->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    // Send native notification to the new session
                    \Filament\Notifications\Notification::make()
                        ->title('Akses Ditolak')
                        ->body('Anda tidak memiliki akses ke panel ' . ucfirst(str_replace('_', ' ', $panel->getId())) . '. Silakan gunakan login panel yang sesuai.')
                        ->danger()
                        ->send();

                    return redirect()->route('filament.' . $correctPanel . '.auth.login');
                }
            }
        });
    })->create();
