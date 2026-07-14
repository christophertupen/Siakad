<?php

namespace App\Filament\Guru\Widgets;

use Filament\Widgets\Widget;
use Carbon\Carbon;

class WelcomeHeader extends Widget
{
    protected static string $view = 'filament.guru.widgets.welcome-header';

    protected static ?int $sort = 1;

    protected int | array | string $columnSpan = 'full';

    public function getViewData(): array
    {
        $now = Carbon::now()->locale('id');
        
        $greeting = match (true) {
            $now->hour >= 5 && $now->hour < 11 => 'Selamat Pagi',
            $now->hour >= 11 && $now->hour < 15 => 'Selamat Siang',
            $now->hour >= 15 && $now->hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };

        return [
            'greeting' => $greeting,
            'userName' => auth()->user()->name,
            'date' => $now->translatedFormat('l, d F Y'),
            'time' => $now->translatedFormat('H:i'),
        ];
    }
}
