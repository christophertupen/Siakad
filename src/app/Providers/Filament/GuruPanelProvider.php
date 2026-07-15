<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class GuruPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('guru')
            ->path('guru')
            ->viteTheme('resources/css/filament/guru/theme.css')

            // Authentication
            ->login()
            ->passwordReset()
            ->profile(EditProfile::class, isSimple: false)

            // Appearance
            ->colors([
                'primary' => Color::Amber,
            ])

            // Auto Discovery
            ->discoverResources(
                in: app_path('Filament/Guru/Resources'),
                for: 'App\\Filament\\Guru\\Resources'
            )

            ->discoverPages(
                in: app_path('Filament/Guru/Pages'),
                for: 'App\\Filament\\Guru\\Pages'
            )

            ->discoverWidgets(
                in: app_path('Filament/Guru/Widgets'),
                for: 'App\\Filament\\Guru\\Widgets'
            )

            // Dashboard
            ->pages([
                \App\Filament\Guru\Pages\Dashboard::class,
            ])

            ->widgets([
                \App\Filament\Guru\Widgets\WelcomeHeader::class,
                \App\Filament\Guru\Widgets\StatsOverview::class,
                \App\Filament\Guru\Widgets\JadwalHariIni::class,
            ])

            // Middleware
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}