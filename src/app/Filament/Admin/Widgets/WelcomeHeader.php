<?php

namespace App\Filament\Admin\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WelcomeHeader extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getColumns(): int
    {
        return 1;
    }

    protected function getStats(): array
    {
        $user = auth()->user();
        $user?->loadMissing('roles');

        $now = Carbon::now()->locale('id');

        return [
            Stat::make(
                sprintf('Selamat %s, %s 👋', $this->getGreeting($now), $user?->name ?? 'Administrator'),
                $this->getRoleLabel()
            )
                ->description($now->translatedFormat('l, d F Y'))
                ->descriptionIcon('heroicon-m-calendar-days')
                ->icon('heroicon-m-sparkles')
                ->color('primary'),
        ];
    }

    private function getGreeting(Carbon $now): string
    {
        return match (true) {
            $now->hour >= 5 && $now->hour < 11 => 'Pagi',
            $now->hour >= 11 && $now->hour < 15 => 'Siang',
            $now->hour >= 15 && $now->hour < 18 => 'Sore',
            default => 'Malam',
        };
    }

    private function getRoleLabel(): string
    {
        $user = auth()->user();
        $user?->loadMissing('roles');

        $roles = $user?->roles
            ->pluck('name')
            ->map(fn (string $role): string => str($role)->headline()->toString())
            ->implode(', ');

        return filled($roles) ? $roles : 'Administrator';
    }
}
